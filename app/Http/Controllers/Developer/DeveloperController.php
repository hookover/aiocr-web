<?php

namespace App\Http\Controllers\Developer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class DeveloperController extends BaseController
{
    public function withdrawAccount(Request $request)
    {

        return view('backend.developer.withdraw_account');
    }

    public function withdrawAccountUpdate(Request $request)
    {
        $real_name = $request->input('real_name');
        $alipay    = $request->input('alipay');
        $user      = $request->user();

        if (!$real_name && !$alipay) {
            return redirect()->back()->withInput()->with('warning', '请填写要更新的项！');
        }

        if ($user->real_name && $user->alipay) {
            return redirect()->back()->withInput()->with('warning', '真实姓名及收款支付宝已填写，不能再次更新！');
        }


        Validator::make(
            ['real_name' => $real_name, 'alipay' => $alipay],
            ['real_name' => 'nullable|min:2|max:20', 'alipay' => 'nullable|min:5|max:36']
        )->validate();


        //更新真实姓名
        if ($real_name && !$user->real_name) {
            $user->real_name = $real_name;
        }

        //更新支付宝
        if ($alipay && !$user->alipay) {
            $user->alipay = $alipay;
        }

        try {
            $user->save();

            return redirect()->back()->withInput()->with('success', '更新成功~');
        } catch (\Exception $exception) {
            return redirect()->back()->withInput()->with('warning', '更新失败，请联系客服!');
        }
    }
}
