@extends('layouts.backend')


@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">更新提款人信息</h4>
            <p class="category">注意：仅可以更新一次，再次更新需要联系客服</p>
        </div>
        <div class="card-content">
            <form method="post"
                  action="{{ route('withdraw-account-developer') }}"
                  class="form-horizontal">
                {{ csrf_field() }}
                <fieldset>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">真实姓名</label>
                        <div class="col-lg-5">
                            @if(!Auth::user()->real_name)
                                <input type="text" name="real_name" value="{{ Auth::user()->real_name }}"
                                       class="form-control">
                            @else
                                <p class="form-control-static">
                                    {{ mb_strlen(Auth::user()->real_name) > 2 ? str_limit(Auth::user()->real_name, $limit = 4, $end = '*') : str_limit(Auth::user()->real_name, $limit = 2, $end = '*') }}
                                </p>
                            @endif
                            @if ($errors->has('real_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('real_name') }}</strong>
                                </span>
                            @else
                                <span class="help-block">
                                    出于安全考虑，此项一经填写永不可以更改
                                </span>
                            @endif
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">收款支付宝</label>
                        <div class="col-lg-5">
                            @if(!Auth::user()->alipay)
                                <input type="text" name="alipay" value="{{ Auth::user()->alipay }}"
                                       class="form-control">
                            @else
                                <p class="form-control-static">
                                    {{ str_limit(Auth::user()->alipay, $limit = 5, $end = '...') }}
                                </p>
                            @endif
                            @if ($errors->has('alipay'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('alipay') }}</strong>
                                </span>
                            @elseif(!Auth::user()->alipay)
                                <span class="help-block">
                                    出于安全考虑，此项一经填写更改会很麻烦
                                </span>
                            @endif
                        </div>
                    </div>
                </fieldset>


                @if(!Auth::user()->alipay || !Auth::user()->real_name)
                    <fieldset>
                        <div class="form-group">
                            <label class="col-lg-2 control-label"></label>
                            <div class="col-lg-9 text-left">
                                <button type="submit" class="btn btn-info btn-fill btn-wd">立即修改</button>
                            </div>
                        </div>
                    </fieldset>
                @endif
            </form>

        </div>
    </div>


@endsection


@section('script')

@endsection