<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Payment;
use App\Models\PaymentGift;
use App\Repositories\CardRepository;
use App\Repositories\PaymentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Pay;

class PaymentController extends BaseController
{
    public function index()
    {

        if (Auth::user()->developer_id) {
            $uid       = Auth::user()->developer_id;
            $user_type = Payment::TYPE_ACCOUNT_DEVELOPER;
        }

        if (Auth::user()->user_id) {
            $uid       = Auth::user()->user_id;
            $user_type = Payment::TYPE_ACCOUNT_USER;
        }

        $payments = Payment::select([
            'payment_id', 'pay_channel_id', 'trade_no',
            'money', 'actual_money', 'point', 'description',
            'status', 'done_at', 'created_at',
        ])
            ->where([['uid', '=', $uid], ['user_type', '=', $user_type]])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        foreach ($payments as $payment) {
            $payment->status_name      = Payment::$status[ $payment->status ];
            $payment->pay_channel_name = Payment::$channels[ $payment->pay_channel_id ];
        }


        $gifts = PaymentGift::select(['condition_money', 'gift_money', 'expiration'])
            ->where([
                ['status', '=', PaymentGift::STATUS_ENABLED],
                ['type', '!=', Auth::user()->developer_id ? PaymentGift::TYPE_USER : PaymentGift::TYPE_DEVELOPER],
            ])->where(function ($query) {
                $query->where('expiration', '>', date('Y-m-d H:i:s'))
                    ->orWhere('expiration', '=', null);
            })->orderBy('condition_money', 'asc')->get();


        return view('backend.payment', ['data' => $payments, 'gifts' => $gifts]);
    }

    public function bankPay(Request $request)
    {
        $bank_number = $request->input('bank_number');
        $bank_money  = $request->input('bank_money');
        $bank_time   = $request->input('bank_time');

        Validator::make(
            [
                'bank_number' => $bank_number,
                'bank_money'  => $bank_money,
                'bank_time'   => $bank_time,
            ],
            [
                'bank_number' => 'required|min:15|max:20',
                'bank_money'  => 'required|numeric|min:1',
                'bank_time'   => 'required|date',
            ]
        )->validate();


        DB::beginTransaction();
        try {
            $payment = PaymentRepository::createBankPay($request);
            if ($payment) {
                PaymentRepository::createPaymentGift($request, $payment);

                DB::commit();

                return $this->responseSuccess('您成功提交了一个金额为￥' . $payment->money . ' 的转款记录，我们将在一个工作日内处理完成');
            }

            DB::rollBack();

            return $this->responseError('转帐记录添加失败，请联系管理员！');

        } catch (\Exception $exception) {
            DB::rollBack();

            return $this->responseError('转帐记录添加失败，请联系管理员！');
        }

    }

    public function cardPay(Request $request)
    {
        $card = $request->input('card');
        Validator::make(
            ['card' => $card,],
            ['card' => 'required|string|min:58|max:58',]
        )->validate();


        try {
            $point = CardRepository::useCard($request->user(), $card, $request->getClientIp());

            if ($point) {
                return $this->responseSuccess('成功充值积分：' . $point);
            }

            return $this->responseError('充值积分失败,可能是系统问题，请联系客服~');
        } catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }


    public function alipay(Request $request)
    {
        $money = $request->input('money');

        Validator::make(
            ['money' => $money,],
            ['money' => 'required|numeric|min:0.01',]
        )->validate();

        $payment = PaymentRepository::createAlipay($request);

        if ($payment) {
            $order = [
                'out_trade_no' => $payment->payment_id,
                'total_amount' => $money,
                'subject'      => '充值积分 - ' . env('USER_DOMAIN'),
            ];

            return Pay::driver('alipay')->gateway('web')->pay($order);
        }

        return redirect()->back()->withInput()->with('warning', '创建充值订单失败，请稍后再试或联系客服！');
    }

    //异步通知
    public function alipayNotify(Request $request)
    {
        if ($data = Pay::driver('alipay')->gateway()->verify($request->all())) {
            // 请自行对 trade_status 进行判断及其它逻辑进行判断，在支付宝的业务通知中，只有交易通知状态为 TRADE_SUCCESS 或 TRADE_FINISHED 时，支付宝才会认定为买家付款成功。
            // 1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号；
            // 2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额）；
            // 3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）；
            // 4、验证app_id是否为该商户本身。
            // 5、其它业务逻辑情况

            //入库加分
            PaymentRepository::paymentDoneAlipay($data);

            // todo 后面确定正常后删掉
            file_put_contents(storage_path('notify.txt'), "收到来自支付宝的异步通知\r\n", FILE_APPEND);
            file_put_contents(storage_path('notify.txt'), '订单号：' . $request->out_trade_no . "\r\n", FILE_APPEND);
            file_put_contents(storage_path('notify.txt'), '订单金额：' . $request->total_amount . "\r\n\r\n", FILE_APPEND);
        } else {
            file_put_contents(storage_path('notify.txt'), "收到异步通知\r\n", FILE_APPEND);
        }

        echo "success";
    }

    //同步通知
    public function alipayReturn(Request $request)
    {
        if ($data = Pay::driver('alipay')->gateway()->verify($request->all())) {
            $payment = PaymentRepository::paymentDoneAlipay($data);

            return view('payment.success', ['data' => $payment]);
        }
        throw new \Exception('支付订单签名验证失败');
    }
}