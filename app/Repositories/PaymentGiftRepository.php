<?php
/**
 * Created by PhpStorm.
 * User: hookover
 * Date: 17-10-16
 * Time: 下午3:38
 */

namespace App\Repositories;

use App\Models\Payment;
use App\Models\PaymentGift;

class PaymentGiftRepository extends BaseRepository
{
    //根据传来的充值记录尝试赠送
    protected function getGift(Payment $payment)
    {
        //仅支持在线充值的几项
        if (!in_array($payment->pay_channel_id, [
            Payment::PAY_CHANNEL_ID_ADMIN,
            Payment::PAY_CHANNEL_ID_BANK,
            Payment::PAY_CHANNEL_ID_ALIPAY,
            Payment::PAY_CHANNEL_ID_TENPAY,
            Payment::PAY_CHANNEL_ID_WEIXINPAY,
        ])) {
            return false;
        }

        $user_type = $payment->user_type == Payment::TYPE_ACCOUNT_USER ? PaymentGift::TYPE_USER : PaymentGift::TYPE_DEVELOPER;


        $gift = PaymentGift::where([
            ['condition_money', '<=', $payment->actual_money],
            ['status', '=', PaymentGift::STATUS_ENABLED],
        ])->where(function ($query) use ($user_type) {
            $query->where('type', '=', $user_type)
                ->orWhere('type', '=', PaymentGift::TYPE_ALL);
        })->where(function ($query) use ($user_type) {
                $query->where('expiration', '>', date('Y-m-d H:i:s'))
                    ->orWhere('expiration', '=', null);
        })->orderBy('gift_money', 'desc') //送得最多的
        ->first();

        return $gift;
    }
}