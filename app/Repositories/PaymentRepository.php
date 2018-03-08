<?php
/**
 * Created by PhpStorm.
 * User: hookover
 * Date: 17-10-16
 * Time: 下午3:38
 */

namespace App\Repositories;

use App\Models\Card;
use App\Models\Developer;
use App\Models\Payment;
use App\Models\User;
use App\Services\Facades\ChannelLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ChannelLog as Log;

class PaymentRepository extends BaseRepository
{
    protected function getUserByPayment(Payment $payment)
    {
        $uid        = $payment->uid;
        $user_guard = $payment->user_type == Payment::TYPE_ACCOUNT_USER ? 'user' : 'developer';


        if ($user_guard == 'user') {
            return User::where('user_id', '=', $uid)->lockForUpdate()->first();
        }

        if ($user_guard == 'developer') {
            return Developer::where('developer_id', '=', $uid)->lockForUpdate()->first();
        }
    }


    //生成系统充值赠送记录
    protected function createPaymentGift(Request $request, Payment $payment)
    {
        if (!$request) {
            throw new \Exception('request对象不能为空！');
        }

        $gift = PaymentGiftRepository::getGift($payment);

        if (!env('MONEY_TO_POINT_PAY', false)) {
            throw new \Exception('充值汇率未配置，请联系管理员');
        }

        if ($gift) {
            $description = "活动赠送：满 {$gift->condition_money} 赠 {$gift->gift_money}";
            $point = $gift->gift_money * env('MONEY_TO_POINT_PAY');

            $attributes = [
                'payment_id'     => \PhpSnowFlake::nextId(99),
                'pay_channel_id' => Payment::PAY_CHANNEL_ID_GIFT,
                'trade_no'       => $payment->payment_id,
                'user_type'      => $payment->user_type,
                'uid'            => $payment->uid,
                'money'          => $gift->gift_money,
                'actual_money'   => 0,
                'point'          => $point,
                'description'    => $description,
                'ip'             => $request->getClientIp(),
            ];


            return Payment::create($attributes);
        }

        return false;
    }

    /**
     * @param Request $request
     *
     * @return bool
     *
     * 管理员手工充值
     */
    protected function createAdminPay(Request $request)
    {
        if (!$request) {
            throw new \Exception('request对象不能为空！');
        }

        $user_type    = $request->input('user_type');
        $uid          = $request->input('uid');
        $money        = $request->input('money');
        $actual_money = $request->input('actual_money');
        $description  = $request->input('description');

        if (!in_array($user_type, [Payment::TYPE_ACCOUNT_USER, Payment::TYPE_ACCOUNT_DEVELOPER])) {
            throw new \Exception('用户类型错误！');
        }

        if (!$uid || !$user_type) {
            throw new \Exception('用户ID或用户类型错误，请联系管理员');
        }

        if ($user_type == Payment::TYPE_ACCOUNT_USER) {
            $user = User::select('id')->where('user_id', '=', $uid)->count();
            if (!$user) {
                throw new \Exception('用户不存在');
            }
        } else {
            $user = Developer::select('id')->where('developer_id', '=', $uid)->count();
            if (!$user) {
                throw new \Exception('开发者不存在');
            }
        }

        if (!env('MONEY_TO_POINT_PAY', false)) {
            throw new \Exception('充值汇率未配置，请联系管理员');
        }

        $point = $money * env('MONEY_TO_POINT_PAY');


        $attributes = [
            'payment_id'     => \PhpSnowFlake::nextId(98),
            'pay_channel_id' => Payment::PAY_CHANNEL_ID_ADMIN,
            'user_type'      => $user_type,
            'uid'            => $uid,
            'money'          => $money,
            'actual_money'   => $actual_money,
            'point'          => $point,
            'description'    => $description,
            'admin_id'       => $request->user()->admin_id,
            'ip'             => $request->getClientIp(),
        ];

        //充值记录
        return Payment::create($attributes);
    }

    /**
     * @param Request $request
     *
     * @return bool
     *
     * 银行卡转帐汇款后，还需要管理在后台进一步审核处理
     */
    protected function createBankPay(Request $request)
    {
        if (!$request) {
            throw new \Exception('request对象不能为空！');
        }

        $uid       = $request->user()->developer_id ? $request->user()->developer_id : $request->user()->user_id;
        $user_type = $request->user()->user_id ? Payment::TYPE_ACCOUNT_USER : Payment::TYPE_ACCOUNT_DEVELOPER;

        if (!$uid || !$user_type) {
            throw new \Exception('用户ID或用户类型错误，请联系管理员');
        }

        if (!env('MONEY_TO_POINT_PAY', false)) {
            throw new \Exception('充值汇率未配置，请联系管理员');
        }
        $point = $request->input('bank_money') * env('MONEY_TO_POINT_PAY');


        $attributes = [
            'payment_id'     => \PhpSnowFlake::nextId(97),
            'pay_channel_id' => Payment::PAY_CHANNEL_ID_BANK,
            'trade_no'       => $request->input('bank_number'),
            'user_type'      => $user_type,
            'uid'            => $uid,
            'money'          => $request->input('bank_money'),
            'actual_money'   => $request->input('bank_money'),
            'point'          => $point,
            'ip'             => $request->getClientIp(),
        ];

        //充值记录
        return Payment::create($attributes);
    }


    /**
     * @param $user_id
     * @param Card $card 点卡列表使用OK的记录
     * 充值卡充值后仅相当于产生一条记录，充值状态已经成功，不需要再次处理
     */
    protected function createCardPay($user_id, Card $card)
    {
        $attributes = [
            'payment_id'     => \PhpSnowFlake::nextId(96),
            'pay_channel_id' => Payment::PAY_CHANNEL_ID_CARD,
            'trade_no'       => $card->card,
            'user_type'      => Payment::TYPE_ACCOUNT_USER,
            'uid'            => $user_id,
            'money'          => $card->money,
            'actual_money'   => 0,
            'point'          => $card->point,
            'ip'             => $card->ip_used,
            'point_before'   => $card->point_before,
            'point_after'    => $card->point_after,
            'done_at'        => $card->time_used,
            'status'         => Payment::STATUS_SUCCESS,
        ];

        return Payment::create($attributes);
    }


    protected function createAlipay(Request $request)
    {
        if (!$request) {
            throw new \Exception('request对象不能为空！');
        }

        $uid       = $request->user()->developer_id ? $request->user()->developer_id : $request->user()->user_id;
        $user_type = $request->user()->user_id ? Payment::TYPE_ACCOUNT_USER : Payment::TYPE_ACCOUNT_DEVELOPER;

        if (!$uid || !$user_type) {
            throw new \Exception('用户ID或用户类型错误，请联系管理员');
        }

        if (!env('MONEY_TO_POINT_PAY', false)) {
            throw new \Exception('充值汇率未配置，请联系管理员');
        }
        $point = $request->input('money') * env('MONEY_TO_POINT_PAY');


        $attributes = [
            'payment_id'     => \PhpSnowFlake::nextId(95),
            'pay_channel_id' => Payment::PAY_CHANNEL_ID_ALIPAY,
            'user_type'      => $user_type,
            'uid'            => $uid,
            'money'          => $request->input('money'),
            'actual_money'   => $request->input('money'),
            'point'          => $point,
            'ip'             => $request->getClientIp(),
        ];

        //充值记录
        return Payment::create($attributes);
    }

    protected function paymentDoneAlipay($alipay_result, $return = true)
    {
        $return_msg = $return ? '同步通知 ' : '异步通知 ';
        //检查支付订单
        $payment = Payment::where([
            ['payment_id', '=', $alipay_result['out_trade_no']],
            ['status', '=', Payment::STATUS_CREATED],
            ['trade_no', '=', null],
        ])->first();
        if (!$payment) {
            Log::write('audit', $return_msg . '订单不存在或已被处理:', $alipay_result);
            throw new \Exception('充值失败，该支付订单已处理或不存在，若有异议，请联系客服！');
        }

        if ($payment->money != $alipay_result['total_amount']) {
            Log::write('audit', $return_msg . '充值金额异常:', $alipay_result);
            throw new \Exception('充值失败，该支付订单支付金额异常，若有异议，请联系客服！');
        }

        if ($this->paymentSuccess($alipay_result['out_trade_no'], $alipay_result['trade_no'])) {
            return $payment;
        }
        Log::write('audit', $return_msg . '充值失败，积分转入异:', $alipay_result);
        throw new \Exception('充值失败，积分转入异常，请联系客服！');
    }

    protected function paymentSuccess($payment_id, $trade_no = null, $admin_id = null)
    {
        return DB::transaction(function () use ($payment_id, $trade_no, $admin_id) {
            $payment = Payment::where([
                ['payment_id', '=', $payment_id],
                ['status', '=', Payment::STATUS_CREATED],
            ])->lockForUpdate()->first();

            if (!$payment) {
                throw new \Exception('该订单不存在或已处理！');
            }

            $user = $this->getUserByPayment($payment);

            if (!$user) {
                throw new \Exception('该订单对应的用户不存在！');
            }

            $payment->point_before   = $user->point_pay_current;
            $payment->point_after    = $user->point_pay_current + $payment->point;
            $user->point_pay_current = $user->point_pay_current + $payment->point;

            $payment->status  = Payment::STATUS_SUCCESS;
            $payment->done_at = date('Y-m-d H:i:s');
            if ($trade_no) {
                $payment->trade_no = $trade_no;
            }
            if($admin_id) {
                $payment->admin_id = $admin_id;
            }

            $payment_grat = Payment::where([
                ['trade_no', '=', $payment->payment_id],
                ['pay_channel_id', '=', Payment::PAY_CHANNEL_ID_GIFT],
                ['status', '=', Payment::STATUS_CREATED],
            ])->lockForUpdate()->first();

            if ($payment_grat) {
                $payment_grat->point_before = $user->point_pay_current;
                $payment_grat->point_after  = $user->point_pay_current + $payment_grat->point;
                $user->point_pay_current    = $user->point_pay_current + $payment_grat->point;

                $payment_grat->status  = Payment::STATUS_SUCCESS;
                $payment_grat->done_at = date('Y-m-d H:i:s');
                try{
                    $payment_grat->save();
                } catch (\Exception $exception) {
                    ChannelLog::write('audit',  '保存满送订单信息失败:', $exception->getMessage());
                    throw new \Exception('保存满送订单信息失败');
                }
            }

            try{
                $user->save();
                $payment->save();
            } catch (\Exception $exception) {
                ChannelLog::write('audit',  '保存充值订单异常:', $exception->getMessage());
                throw new \Exception('保存充值订单异常，请联系客服');
            }

            return true;
        });
    }

    protected function paymentFail($payment_id, $description = null, $admin_id = null)
    {
        return DB::transaction(function () use ($payment_id, $description, $admin_id) {
            $payment = Payment::where([
                ['payment_id', '=', $payment_id],
                ['status', '=', Payment::STATUS_CREATED],
            ])->lockForUpdate()->first();

            if (!$payment) {
                throw new \Exception('该订单不存在或已处理！');
            }

            $payment->status  = Payment::STATUS_FAILED;
            $payment->done_at = date('Y-m-d H:i:s');

            if($description) {
                $payment->description   = $description;
            }
            if($admin_id) {
                $payment->admin_id = $admin_id;
            }

            $payment_grat = Payment::where([
                ['trade_no', '=', $payment->payment_id],
                ['pay_channel_id', '=', Payment::PAY_CHANNEL_ID_GIFT],
                ['status', '=', Payment::STATUS_CREATED],
            ])->lockForUpdate()->first();

            if ($payment_grat) {
                if($admin_id) {
                    $payment_grat->admin_id = $admin_id;
                }
                $payment_grat->status  = Payment::STATUS_FAILED;
                $payment_grat->done_at = date('Y-m-d H:i:s');
                try{
                    $payment_grat->save();
                } catch (\Exception $exception) {
                    ChannelLog::write('audit',  '保存满送订单信息失败:', $exception->getMessage());
                    throw new \Exception('保存满送订单信息失败');
                }
            }

            try{
                $payment->save();
            } catch (\Exception $exception) {
                ChannelLog::write('audit',  '保存充值订单异常:', $exception->getMessage());
                throw new \Exception('保存充值订单异常，请联系程序狗');
            }

            return true;
        });
    }
}