<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Withdraw;
use App\Repositories\WithdrawRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends BaseController
{
    public function index()
    {
        $developer_id = Auth::user()->developer_id;

        $withdraws = Withdraw::select([
            'uuid', 'channel_id', 'account',
            'money', 'point', 'description',
            'status', 'done_at', 'created_at', 'updated_at',
        ])
            ->where([['developer_id', '=', $developer_id]])
            ->orderBy('created_at')->paginate();

        foreach ($withdraws as $withdraw) {
            $withdraw->status       = Withdraw::$status[ $withdraw->status ];
            $withdraw->channel_name = Withdraw::$channels[ $withdraw->channel_id ];
        }

        return view('backend.developer.withdraw', ['data' => $withdraws]);
    }

    public function withdraw(Request $request)
    {
        $user = $request->user();

        if (!$user->real_name) {
            return $this->responseError('收款人姓名未填写！');
        }

        if (!$user->alipay) {
            return $this->responseError('收款支付宝未填写！');
        }

        try {
            $withdraw = WithdrawRepository::withdraw($request);

            if ($withdraw) {
                return $this->responseSuccess('提现申请成功，2个工作日内将到帐', ['money' => $withdraw->money]);
            }

            return $this->responseError('提现失败~');

        } catch (\Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }
}