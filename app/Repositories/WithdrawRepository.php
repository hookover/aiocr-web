<?php
/**
 * Created by PhpStorm.
 * User: hookover
 * Date: 17-10-16
 * Time: 下午3:38
 */

namespace App\Repositories;

use App\Models\Developer;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class WithdrawRepository extends BaseRepository
{
    protected function withdraw(Request $request)
    {

        $withdraw = DB::transaction(function () use ($request) {
            $user = Developer::where('developer_id', '=', $request->user()->developer_id)->lockForUpdate()->first();
            if (!$user) {
                throw new \Exception('用户账户不存在或加锁失败~');
            }

            //计算金额

            if (!env('MONEY_TO_POINT_WITHDRAW', false)) {
                throw new \Exception('提现汇率未配置，请联系客服！！！');
            }

            $current_money = floor($user->point_dividend_current / env('MONEY_TO_POINT_WITHDRAW'));
            $current_money_point = intval($current_money * env('MONEY_TO_POINT_WITHDRAW'));
            $point_after = $user->point_dividend_current - $current_money_point;


            if ($current_money < env('DEVELOPER_WITHDRAW', 50)) {
                throw new \Exception('可提现金额为：￥' . $current_money . '，不满足最低提现额限制！');
            }

            $attributes = [
                'uuid'         => Uuid::uuid1()->toString(),
                'developer_id' => $user->developer_id,
                'channel_id'   => Withdraw::CHANNEL_ALIPAY,
                'account'      => $user->alipay,
                'real_name'    => $user->real_name,
                'money'        => $current_money,
                'point'        => $current_money_point,
                'point_before' => $user->point_dividend_current,
                'point_after'  => $point_after,
                'ip_created'   => $request->getClientIp(),
            ];

            $user->point_dividend_current = $point_after;
            $user->save();

            $withdraw = Withdraw::create($attributes);

            return $withdraw;
        });

        return $withdraw;
    }
}