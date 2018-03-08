<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

class CaptchaController extends BaseController
{
    public function show(CaptchaBuilder $builder)
    {
        $builder->setPhrase((new PhraseBuilder(4))->build());
        $builder->build(150, 40);

        \Session::put('captcha', $builder->getPhrase()); //存储验证码

        return response($builder->output())->header('Content-type', 'image/jpeg');
    }
}
