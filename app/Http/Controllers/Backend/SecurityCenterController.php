<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller as BaseController;
use App\Repositories\DeveloperRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class SecurityCenterController extends BaseController
{
    protected function validator(array $data)
    {
        $validator = [
            'old_password' => 'required|string',
            'password'     => 'required|string|min:6|max:30|confirmed',
        ];

        return Validator::make($data, $validator);
    }

    public function resetPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $old_password = $request->input('old_password');
            $password     = $request->input('password');

            $this->validator($request->all())->validate();

            if ($old_password == $password) {
                throw ValidationException::withMessages([
                    'password' => ['新密码与旧密码不宜相同'],
                ]);
            }

            if (!Hash::check($old_password, $request->user()->password)) {
                throw ValidationException::withMessages([
                    'old_password' => ['原密码验证失败'],
                ]);
            }

            $request->user()->password = bcrypt($password);
            $request->user()->salt     = Str::random(32);
            $request->user()->save();

            return redirect()->back()->withInput()->with('success', '密码修改成功！');
        }

        return view('backend.reset-password');
    }

    public function resetUserInfo()
    {
        return view('backend.reset-userinfo');
    }

    public function resetToken(Request $request)
    {
        $user = $request->user();

        if ($user->user_id) {
            $user->api_token = UserRepository::getOnlyToken();
        }
        if ($user->developer_id) {
            $user->api_token = DeveloperRepository::getOnlyToken();
        }

        try {
            $user->salt                 = Str::random(32);
            $user->api_token_created_at = date('Y-m-d H:i:s');
            $user->save();
            UserRepository::setUserAllInfoToCacheByUID($user);

            return redirect()->back()->withInput()->with('success', '恭喜，重置成功！');
        } catch (\Exception $exception) {
            UserRepository::removeUserAllInfoFromCacheByUID($user->user_id);

            return redirect()->back()->withInput()->with('warning', '重置失败，请重试！');
        }
    }


    public function updateUserInfo(Request $request)
    {
        $phone    = $request->input('phone');
        $username = $request->input('username');
        $qq       = $request->input('qq');
        $user     = $request->user();


        $validator = [
            'username' => 'nullable|string|regex:/^[a-z][a-z0-9]{6,32}$/|unique:users',
            'phone'    => 'nullable|string|regex:/^1[34578][0-9]{9}$/|unique:users',
            'qq'       => 'nullable|numeric|regex:/^[1-9][0-9]{5,20}$/',
        ];
        if ($user->developer_id) {
            $validator['username'] = 'nullable|string|regex:/^[a-z][a-z0-9]{6,32}$/|unique:developers';
            $validator['phone']    = 'nullable|string|regex:/^1[34578][0-9]{9}$/|unique:developers';
        }

        Validator::make(['phone' => $phone, 'username' => $username, 'qq' => $qq], $validator)->validate();


        if (!$user->phone) {
            $user->phone = $phone;
        }

        if (!$user->username) {
            $user->username = $username;
        }

        if (!$user->qq) {
            $user->qq = $qq;
        }

        try {
            $user->save();

            return redirect()->back()->withInput()->with('success', '更新成功~');

        } catch (\Exception $exception) {
            return redirect()->back()->withInput()->with('warning', '更新失败，请联系客服!');
        }
    }
}
