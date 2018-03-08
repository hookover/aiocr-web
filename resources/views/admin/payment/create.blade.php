@extends('layouts.backend')

@section('content')
    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">充值</h4>
                    <p class="category">
                        <a href="{{ url('/admin/payment') }}" title="Back">
                            <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                    </p>
                </div>
                <div class="card-content">
                    <div class="form-horizontal">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">用户类型</label>
                                <div class="col-lg-6 text-left">
                                    @foreach(\App\Models\Payment::$user_types as $value=>$name)
                                        <div class="radio">
                                            <input type="radio" name="user_type" id="{{ 'user_type' . $value }}"
                                                   {{ $value == \App\Models\Payment::TYPE_ACCOUNT_USER ? 'checked="checked"': '' }}
                                                   value="{{ $value }}">
                                            <label for="{{ 'user_type' . $value }}">
                                                {{ $name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">用户ID</label>
                                <div class="col-lg-6 text-left">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <input name="uid" type="number" placeholder="开发者的developer_id或用户的user_id"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">充值金额</label>
                                <div class="col-lg-6 text-left">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <div class="input-group">
                                                <span class="input-group-addon">￥</span>
                                                <input name="money" type="number" placeholder="充值金额"
                                                       class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-xs-3">
                                            <div class="input-group">
                                                <span class="input-group-addon">￥</span>
                                                <input name="actual_money" type="number" placeholder="实际充值金额"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <span class="help-block text-left">
                                        请准确填写充值金额和实际充值金额，充值金额表示给用户充值多少钱，实充金额表示我们真正收到多少钱
                                    </span>
                                </div>
                            </div>
                        </fieldset>


                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">备注</label>
                                <div class="col-lg-6">
                                    <textarea name="description" class="form-control"
                                              placeholder="请备注好啥情况，比如活动，赠送，线下转账"></textarea>
                                </div>
                            </div>
                        </fieldset>


                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-3 control-label"></label>
                                <div class="col-lg-9 text-left">
                                    <button id="admin_pay" onclick="admin.adminPay('{{route('payment-admin')}}')"
                                            class="btn btn-primary btn-fill btn-wd">管理员手工充值
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
