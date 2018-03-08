<?php

namespace App\Http\Controllers\User;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    public function pointLock(Request $request)
    {
        $point = $request->input('point', 0);

        Validator::make(
            ['point' => $point],
            ['point' => 'required|numeric|min:1',]
        )->validate();

        $user = $request->user();

        if ($point > $user->point_pay_current) {
            return $this->responseError('剩余可用积分不足~');
        }

        DB::beginTransaction();
        try {
            $user->point_pay_current = $user->point_pay_current - $point;
            $user->point_locked      = $user->point_locked + $point;

            $user->save();
            DB::commit();
            UserRepository::removeUserAllInfoFromCacheByUID($user->user_id);

            return $this->responseSuccess('积分锁定成功！');
        } catch (\Exception $exception) {
            DB::rollback();

            return $this->responseError('-100001, 保存失败，请联系客服！');
        }
    }

    public function pointUNLock(Request $request)
    {
        $point = $request->input('point', 0);

        Validator::make(
            ['point' => $point],
            ['point' => 'required|numeric|min:1',]
        )->validate();

        $user = $request->user();

        if ($point > $user->point_locked) {
            return $this->responseError('剩余可解锁积分不足~');
        }

        DB::beginTransaction();
        try {
            $user->point_locked      = $user->point_locked - $point;
            $user->point_pay_current = $user->point_pay_current + $point;

            $user->save();
            DB::commit();

            UserRepository::removeUserAllInfoFromCacheByUID($user->user_id);

            return $this->responseSuccess('积分解锁成功！');
        } catch (\Exception $exception) {
            DB::rollback();

            return $this->responseError('-100001, 保存失败，请联系客服！');
        }
    }
}
