<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
    use Illuminate\Validation\ValidationException;


class SecurityCenterController extends Controller
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
            $request->user()->save();

            return redirect()->back()->withInput()->with('success', '密码修改成功！');
        }

        return view('admin.reset-password');
    }
}
