@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">注册</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('user_type') ? ' has-error' : '' }}">
                            <label for="user_type" class="col-md-4 control-label">账户类型</label>

                            <div class="col-md-6">
                                <label class="radio-inline">
                                    <input type="radio" name="user_type" value="user" {{ (old('user_type') == 'user' || old('user_type') != 'developer') ? 'checked="checked"' : '' }}> 普通用户
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="user_type" value="developer" {{ old('user_type') == 'developer' ? 'checked="checked"' : '' }}> 开发者
                                </label>

                                @if ($errors->has('user_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">邮箱地址 <span class="text-danger">（必填）</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @else
                                    <span class="help-block">
                                        邮箱、用户名、手机号均可登录，但邮箱必须填写
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">手机号码</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">用户名</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}">

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @else
                                    <span class="help-block">
                                        <strong>若填写用户名，请务必以英文开头</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('qq') ? ' has-error' : '' }}">
                            <label for="qq" class="col-md-4 control-label">QQ号</label>

                            <div class="col-md-6">
                                <input id="qq" type="text" class="form-control" name="qq" value="{{ old('qq') }}">

                                @if ($errors->has('qq'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('qq') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">密码 <span class="text-danger">（必填）</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">重复密码 <span class="text-danger">（必填）</span></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">验证码</label>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <input id="captcha" type="text" class="form-control" name="captcha" required>
                                    </div>
                                    <div class="col-xs-8">
                                        <img style="cursor: pointer;" onclick="this.src='/captcha?' + Math.random()" src="/captcha" alt="">
                                    </div>
                                </div>

                                @if ($errors->has('captcha'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="agreement" checked> 同意<a href="/agreement" target="_blank">《使用协议》</a>
                                    </label>
                                </div>
                                @if ($errors->has('agreement'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('agreement') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    立即注册
                                </button>
                                <a class="btn btn-link" href="{{ route('login') }}">
                                    已有账号，去登录？
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
