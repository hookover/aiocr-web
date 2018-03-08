@extends('layouts.web_auth')

@section('content')
    <style>
        .form-check-label {
            padding-left: 2.00rem;
            margin-bottom: 0;
        }
        .card > .card-title {
            margin: 0;
            padding: 20px 0;
        }
        .help-block {
            display: block;
            margin-top: 5px;
            margin-bottom: 10px;
            color: #a94442;
        }
        .form-group{
            margin-bottom:0;
        }
    </style>
    <div class="wrapper">
        <div class="page-header" style="background-image: url('/web/assets/img/bruno-abatti.jpg');">
            <div class="filter"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ml-auto mr-auto">
                        <div class="card card-register" style="margin:0 auto;">
                            <h3 class="card-title">Welcome</h3>
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                                <div class="col-xs-12 form-group{{ $errors->has('user_type') ? ' has-error' : '' }}">
                                    <h5 style="font-size:14px;font-weight: 300;">帐户类型</h5>
                                        <label class="form-check-label col-sm-6 form-check-radio" style="margin-top:0;">
                                            <input class="form-check-input" type="radio" name="user_type" value="user" checked> 普通用户
                                            <span class="form-check-sign"></span>
                                        </label>
                                        <label class="form-check-label col-sm-6 form-check-radio pull-right" style="margin-top:0;">
                                            <input class="form-check-input" type="radio" name="user_type" value="developer"> 开发者
                                            <span class="form-check-sign"></span>
                                        </label>
                                </div>
                                @if ($errors->has('user_type'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('user_type') }}</strong>
                                        </span>
                                @endif

                                <div class="col-xs-12 form-group{{ $errors->has('account') ? ' has-error' : '' }}">
                                    <label>用户名/邮箱/手机号</label>
                                    <input id="account" type="text" class="form-control no-border" name="account" value="{{ old('account') }}" required autofocus placeholder="用户名/邮箱/手机号">
                                </div>
                                @if ($errors->has('account'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('account') }}</strong>
                                    </span>
                                @endif

                                <div class="col-xs-12 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label>密码</label>
                                    <input id="password" type="password" class="form-control  no-border" name="password" required placeholder="密码">
                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                                <div class="col-xs-12 form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                                    <h5 style="font-size:14px;font-weight: 300;margin-top:15px;">验证码</h5>
                                    <label class="form-check-label form-check-radio" style="margin-top:0;padding-left:1.3rem;width:34%">
                                        <input id="captcha" style="width:130%" class="form-check-input form-control" type="text" name="captcha" required>
                                    </label>
                                    <label class="form-check-label form-check-radio pull-right" style="margin-top:0;padding-left:0">
                                        <img style="cursor: pointer; width:140px;border-radius: 0;position: relative;top:6px;" onclick="this.src='/captcha?' + Math.random()" src="/captcha" alt="">
                                    </label>
                                </div>
                                @if ($errors->has('captcha'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                @endif

                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        记住我
                                        <span class="form-check-sign"></span>
                                    </label>
                                </div>

                                <button type="submit" class="btn btn-danger btn-block btn-round">立即登录</button>
                            </form>
                            <div class="forgot">
                                <a class="btn btn-link btn-danger" href="{{ route('password.request') }}">
                                    忘记密码，立即找回?
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center" style="margin-top:30px;">
                    <h6>&copy; <script>document.write(new Date().getFullYear())</script> jiqishibie.com<i class="fa fa-heart heart"></i> made with love</h6>
                </div>
            </div>
        </div>
    </div>
@endsection