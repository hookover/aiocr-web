@extends('layouts.backend')


@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">修改密码</h4>
            <p class="category"></p>
        </div>
        <div class="card-content">
            <form method="post"
                  action="{{ Auth::user()->user_id ? route('reset-password-user') : route('reset-password-developer') }}"
                  class="form-horizontal">
                {{ csrf_field() }}
                <fieldset>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">旧密码</label>
                        <div class="col-lg-5">
                            <input type="password" name="old_password" class="form-control">
                            @if ($errors->has('old_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('old_password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">新密码</label>
                        <div class="col-lg-5">
                            <input type="password" name="password" class="form-control">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">重复新密码</label>
                        <div class="col-lg-5">
                            <input type="password" name="password_confirmation" class="form-control">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label class="col-lg-2 control-label"></label>
                        <div class="col-lg-9 text-left">
                            <button type="submit" class="btn btn-info btn-fill btn-wd">立即修改</button>
                        </div>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>


@endsection


@section('script')

@endsection