<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    //根据登录用户类型赋值user / developer
    protected $guard = 'user';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validateEmail(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required|email',
            'user_type' => 'required|in:user,developer',
        ]);
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

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $this->validateUserType($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    public function broker()
    {
        return Password::broker($this->guard);
    }
}
