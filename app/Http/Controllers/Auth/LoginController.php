<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use App\Models\DeveloperLog;
use App\Models\User;
use App\Models\UserLog;
use App\Repositories\DeveloperLogRepository;
use App\Repositories\UserLogRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    //根据登录用户类型赋值user / developer
    protected $guard = 'user';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    protected function redirectTo()
    {
        if ($this->guard == 'user') {
            return '/user/dashboard';
        }

        return '/developer/dashboard';
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

    public function login(Request $request)
    {
        $this->validateLogin($request);

        //用户类型没有填写
        $this->validateUserType($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function attemptLogin(Request $request)
    {

        $base_credentials = [
            'password' => $request->input('password'),
        ];
        $username         = [
            'username' => $request->input($this->username()),
        ];
        $phone            = [
            'phone' => $request->input($this->username()),
        ];
        $email            = [
            'email' => $request->input($this->username()),
        ];


        if (($status = $this->guard()->attempt(array_merge($base_credentials, $username))) ||
            ($status = $this->guard()->attempt(array_merge($base_credentials, $phone))) ||
            ($status = $this->guard()->attempt(array_merge($base_credentials, $email)))
        ) {
            $user = $this->guard()->user();

            if($user->status_account == User::STATUS_ACCOUNT_LOCKED || $user->status_account == Developer::STATUS_ACCOUNT_LOCKED) {
                throw ValidationException::withMessages([
                    'account' => ['该帐户已被锁定，请联系客服。'],
                ]);
            }

            $user->ip_pre_login  = $user->ip_last_login;
            $user->ip_last_login = ip2long($request->getClientIp());

            $user->time_pre_login  = $user->time_last_login;
            $user->time_last_login = date('Y-m-d H:i:s');

            $user->count_login = $user->count_login + 1;

            $user->save();

            if ($user->user_id) {
                UserLogRepository::create($request, $user->user_id, UserLog::LOG_STATUS_LOGIN_SUCCESS);
            }
            if ($user->developer_id) {
                DeveloperLogRepository::create($request, $user->developer_id, DeveloperLog::LOG_STATUS_LOGIN_SUCCESS);
            }
        }

        return $status;
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return redirect()->to($this->redirectPath());
    }

    public function username()
    {
        return 'account';
    }

    protected function guard()
    {
        return Auth::guard($this->guard);
    }
}
