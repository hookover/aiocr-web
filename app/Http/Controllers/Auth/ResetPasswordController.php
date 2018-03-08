<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    //根据登录用户类型赋值user / developer
    protected $guard = 'user';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function redirectTo()
    {
        if($this->guard =='user')
        {
            return '/user';
        }

        return '/developer';
    }
    protected function validateUserType(Request $request)
    {
        $user_type = $request->input('user_type');

        switch ($user_type) {
            case 'user':
                $this->guard = 'user';
                break;
            case 'developer':
                $this->guard = 'developer';
                break;
            default:
                throw ValidationException::withMessages([
                    'user_type' => ['用户类型选择错误'],
                ]);
        }
        return true;
    }

    public function reset(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        //用户类型没有填写
        $this->validateUserType($request);

        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
            $this->resetPassword($user, $password);
        }
        );

        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($response)
            : $this->sendResetFailedResponse($request, $response);
    }

    public function broker()
    {
        return Password::broker($this->guard);
    }

    protected function guard()
    {
        return Auth::guard($this->guard);
    }
}
