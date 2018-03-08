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
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CardRepository extends BaseRepository
{
    protected function useCard(User $user, $card, $ip)
    {
        if (!$user->user_id) {
            throw new \Exception('用户错误！！！');
        }

        return DB::transaction(function () use ($user, $card, $ip) {
            $user = User::select(['id', 'user_id', 'point_pay_current'])
                ->where([['user_id', '=', $user->user_id]])
                ->lockForUpdate()
                ->first();

            $card = Card::where([['card', '=', $card], ['status', '=', Card::CARD_VALID]])
                ->lockForUpdate()
                ->first();

            if (!$card) {
                throw new \Exception('该充值卡无效！！！');
            }

            //开始充值
            $card->status            = Card::CARD_IS_USED;
            $card->time_used         = date('Y-m-d H:i:s');
            $card->ip_used           = $ip;
            $card->point_before      = $user->point_pay_current;
            $card->point_after       = $user->point_pay_current + $card->point;
            $card->user_id           = $user->user_id;
            $user->point_pay_current = $user->point_pay_current + $card->point;


            $res = PaymentRepository::createCardPay($user->user_id, $card);

            if ($res) {
                $card->save();
                $user->save();

                return $card->point;
            }

            return false;
        });

    }

    protected function createCardByNumber(Request $request, $money_to_point)
    {
        #card
        $number        = $request->input('number');
        $card_money    = $request->input('card_money');
        $developer_id  = $request->user()->developer_id;
        $card_to_point = $card_money * env('MONEY_TO_POINT_PAY');
        $ip            = $request->getClientIp();
        $time          = date('Y-m-d H:i:s');
        #全部点卡
        $cards = [];
        #预生成数据
        for ($i = 0; $i < $number; $i++) {
            $cards[] = [
                'developer_id' => $developer_id,
                'card'         => Str::random(58),
                'point'        => $card_to_point,
                'money'        => $card_money,
                'ip_created'   => $ip,
                'created_at'   => $time,
            ];
        }

        DB::beginTransaction();
        try {
            $user = Developer::select(['id', 'developer_id', 'point_pay_current', 'point_dividend_current'])
                ->where([['developer_id', '=', $request->user()->developer_id]])
                ->lockForUpdate()
                ->first();

            $db_point = $user->point_pay_current + $user->point_dividend_current;

            if ($db_point < $money_to_point) {
                throw new ValidationException("账户余额点数不足,请先行充值。");
            }

            #扣费逻辑
            #如果单项积分够
            if ($money_to_point < $user->point_dividend_current) {
                #先扣可提现的
                $user->point_dividend_current = $user->point_dividend_current - $money_to_point;
                $user->save();
                $res = $this->createCards($cards);

                DB::commit();

                return $res;
            } elseif ($money_to_point < $user->point_pay_current) {
                #再扣已充值的
                $user->point_pay_current = $user->point_pay_current - $money_to_point;
                $user->save();
                $res = $this->createCards($cards);

                DB::commit();

                return $res;
            }

            #如果单项积分不够
            #先扣光可提现的
            $money_to_point               = $money_to_point - $user->point_dividend_current;
            $user->point_dividend_current = 0;

            #再扣充值的
            $user->point_pay_current = $user->point_pay_current - $money_to_point;

            $user->save();
            $res = $this->createCards($cards);

            DB::commit();

            return $res;
        } catch (\Exception $exception) {
            DB::rollback();

            return redirect()->back()->withInput()->with('warning', $exception->getMessage());
        }

    }

    private function createCards($cards)
    {
        return Card::insert($cards);
    }
}