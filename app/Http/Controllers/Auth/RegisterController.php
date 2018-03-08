<?php

namespace App\Http\Controllers\Auth;

use App\Repositories\DeveloperRepository;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $guard = 'user';

    public function __construct()
    {
        $this->middleware('guest');
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

    protected function validator(array $data)
    {
        $validator = [
            'user_type' => 'required|string',
            'password'  => 'required|string|min:6|confirmed',
            'email'     => 'required|string|email|max:64|unique:users',
            'username'  => 'nullable|string|regex:/^[a-z][a-z0-9]{6,32}$/|unique:users',
            'phone'     => 'nullable|string|regex:/^1[34578][0-9]{9}$/|unique:users',
            'qq'        => 'nullable|numeric|regex:/^[1-9][0-9]{5,20}$/',
        ];
        if ($this->guard == 'developer') {
            $validator['email']    = 'required|string|email|max:64|unique:developers';
            $validator['username'] = 'nullable|string|regex:/^[a-z][a-z0-9]{6,32}$/|unique:developers';
            $validator['phone']    = 'nullable|string|regex:/^1[34578][0-9]{9}$/|unique:developers';
        }


        return Validator::make($data, $validator);
    }

    public function register(Request $request)
    {
        $this->validateUserType($request);

        $this->validator($request->all())->validate();

        if(!$request->input('agreement')) {
            throw ValidationException::withMessages([
                'agreement' => ['您必须同意使用协议才可以注册！'],
            ]);
        }

        $user = [
            'email'           => $request->input('email'),
            'username'        => $request->input('username'),
            'phone'           => $request->input('phone'),
            'password'        => $request->input('password'),
            'qq'              => $request->input('qq'),
            'ip_register'     => ip2long($request->getClientIp()),
            'ip_last_login'   => ip2long($request->getClientIp()),
            'time_last_login' => date('Y-m-d H:i:s'),
            'api_token'       => ($this->guard == 'user') ? UserRepository::getOnlyToken() : DeveloperRepository::getOnlyToken(),
        ];

        event(new Registered($user = $this->create($user)));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    protected function create(array $data)
    {
        $data['password'] = bcrypt($data['password']);

        if ($this->guard == 'user') {
            return UserRepository::create($data);
        }

        if ($this->guard == 'developer') {
            return DeveloperRepository::create($data);
        }

        throw ValidationException::withMessages([
            'user_type' => ['用户类型选择错误'],
        ]);
    }

    protected function guard()
    {
        return Auth::guard($this->guard);
    }
}
