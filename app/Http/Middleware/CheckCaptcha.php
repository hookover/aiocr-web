<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class CheckCaptcha
{
    public function handle($request, Closure $next)
    {
        $captcha = $request->input('captcha');

        if (!$captcha || $captcha != Session::get('captcha')) {
            throw ValidationException::withMessages([
                'captcha' => ['验证码错误'],
            ]);
        }
        Session::remove('captcha');

        return $next($request);
    }
}
