@extends('layouts.backend')


@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">修改用户信息</h4>
            <p class="category"></p>
        </div>
        <div class="card-content">
            <form method="post"
                  action="{{ Auth::user()->user_id ? route('update-user-info-user') : route('update-user-info-developer') }}"
                  class="form-horizontal">
                {{ csrf_field() }}

                <fieldset>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">邮箱</label>
                        <div class="col-lg-5">
                            <input type="text" value="{{Auth::user()->email}}" class="form-control" disabled>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @elseif(Auth::user()->email)
                                <span class="help-block">
                                <a href="#" onclick="app.alertError('功能暂未启用')">修改邮箱</a>
                            </span>
                            @endif
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">手机号</label>
                        <div class="col-lg-5">
                            @if(!Auth::user()->phone)
                                <input type="text" name="phone" value="{{Auth::user()->phone}}" class="form-control">
                            @else
                                <p class="form-control-static">{{Auth::user()->phone}}</p>
                            @endif


                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @elseif(Auth::user()->phone)
                                <span class="help-block">
                                <a href="#" onclick="app.alertError('功能暂未启用')">修改手机号</a>
                            </span>
                            @endif
                        </div>
                    </div>
                </fieldset>


                <fieldset>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">用户名</label>
                        <div class="col-lg-5">
                            @if(!Auth::user()->username)
                                <input type="text" name="username" value="{{Auth::user()->username}}"
                                       class="form-control">
                            @else
                                <p class="form-control-static">{{Auth::user()->username}}</p>
                            @endif

                            @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @elseif(Auth::user()->username)
                                <span class="help-block">
                                    <a href="#" onclick="app.alertError('功能暂未启用')">修改用户名</a>
                                </span>
                            @endif
                        </div>
                    </div>
                </fieldset>


                <fieldset>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">QQ</label>
                        <div class="col-lg-5">
                            @if(!Auth::user()->qq)
                                <input type="text" name="qq" value="{{Auth::user()->qq}}" class="form-control">
                            @else
                                <p class="form-control-static">{{Auth::user()->qq}}</p>
                            @endif

                            @if ($errors->has('qq'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('qq') }}</strong>
                                </span>
                            @elseif(Auth::user()->qq)
                                <span class="help-block">
                                    <a href="#" onclick="app.alertError('功能暂未启用')">修改QQ</a>
                                </span>
                            @endif
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label class="col-lg-2 control-label"></label>
                        <div class="col-lg-9 text-left">
                            <button class="btn btn-info btn-fill btn-wd">保存修改</button>
                        </div>
                    </div>
                </fieldset>

            </form>

        </div>
    </div>


@endsection


@section('script')

@endsection