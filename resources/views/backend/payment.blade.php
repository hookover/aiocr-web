@extends('layouts.backend')


@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">充值</h4>
            <p class="category">充值到余额点数，开发者充值只能用于生成点卡，不能消费</p>
        </div>
        <div class="card-content">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                        <li class="active"><a href="#online" data-toggle="tab" aria-expanded="true">在线充值</a></li>
                        @if(Auth::user()->user_id)
                            <li class=""><a href="#card" data-toggle="tab" aria-expanded="false">点卡充值</a></li>
                        @endif
                        <li class=""><a href="#offline" data-toggle="tab" aria-expanded="false">银行转帐充值</a></li>
                        <li class=""><a href="#discount" data-toggle="tab" aria-expanded="false"><i class="ti-gift"></i> 满就送</a></li>
                    </ul>
                </div>
            </div>
            <div id="my-tab-content" class="tab-content text-center">
                <div class="tab-pane active" id="online">


                    <div class="form-horizontal">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">充值金额</label>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">￥</span>
                                        <input type="number" name="alipay_money" value="100" class="form-control">
                                        <span class="input-group-addon">.00</span>
                                    </div>

                                    <span class="help-block text-left">
                                        超大额充值优惠请联系客服.
                                    </span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-3 control-label"></label>
                                <div class="col-lg-9 text-left">
                                    <button id="alipay_pay_button" onclick="app.aliPay('{{ Auth::user()->user_id ? route('payment-aliapy-user') : route('payment-aliapy-developer') }}')" class="btn btn-info btn-fill btn-wd">立即充值</button>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                </div>
                <div class="tab-pane" id="card">


                    <div class="form-horizontal">
                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">请输入卡号</label>
                                <div class="col-lg-6">
                                    <input name="card" type="text" class="form-control">
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-3 control-label"></label>
                                <div class="col-lg-9 text-left">
                                    <button onclick="app.cardPay('{{ route('payment-card-user') }}')"
                                            class="btn btn-success btn-fill btn-wd">立即充值
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </div>


                </div>
                <div class="tab-pane" id="offline">
                    <div class="form-horizontal">

                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">开户银行</label>
                                <div class="col-lg-6 text-left">
                                    <p class="form-control-static">
                                        {{env('OFFLINE_BANK_NAME', '未配置')}}
                                    </p>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">卡号</label>
                                <div class="col-lg-6 text-left">
                                    <p class="form-control-static">
                                        {{env('OFFLINE_BANK_NUMBER', '未配置')}}
                                    </p>
                                </div>
                            </div>
                        </fieldset>


                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">您使用的网银账号</label>
                                <div class="col-lg-6">
                                    <input name="bank_number" type="text" class="form-control">
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">转帐金额</label>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">￥</span>
                                        <input name="bank_money" type="number" class="form-control">
                                    </div>
                                    <span class="help-block text-left">
                                        银行转款请多转一个零头，以方便我们区分，如：100.08
                                    </span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">转帐时间</label>
                                <div class="col-lg-6">
                                    <input type="text" name="bank_time" class="form-control datetimepicker"
                                           placeholder="请填写转帐时间">
                                    <span class="help-block text-left">
                                        请尽量与您的转帐回执单上时间保持一致
                                        <div class="text-danger">
                                        请先通过网上或线下银行向我们转帐汇款后，再填写此表单。
                                       我们将在一个工作日内将积分转入您的帐户。
                                    </div>
                                    </span>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-3 control-label"></label>
                                <div class="col-lg-9 text-left">
                                    <button id="bank_pay_button" onclick="app.bankPay('{{ Auth::user()->user_id ? route('payment-bank-user') : route('payment-bank-developer') }}')"
                                            class="btn btn-primary btn-fill btn-wd">提交转帐信息
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="tab-pane" id="discount">
                    <div class="row text-left">
                        <div class="col-lg-6 col-lg-offset-3">
                            <table class="table table-striped table-no-bordered table-hover" cellspacing="0">
                                <thead>
                                <tr class="s12">
                                    <th>单次充值满</th>
                                    <th>送</th>
                                    <th class="disabled-sorting">截止时间</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($gifts as $gift)
                                <tr>
                                    <td>{{ number_format($gift->condition_money, 2, '.', ',') }}</td>
                                    <td>{{ number_format($gift->gift_money, 2, '.', ',') }}</td>
                                    <td>
                                        {{ $gift->expiration ? $gift->expiration : '暂不过期' }}
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-content">
            <div class="toolbar">
                <!--Here you can write extra buttons/actions for the toolbar-->
            </div>
            <table id="bootstrap-table" class="table">
                <thead>
                <tr>
                    <th>平台充值单号</th>
                    <th>充值渠道</th>
                    <th>第三方支付平台充值单号/充值卡号/转款银行卡号</th>
                    <th>充值金额</th>
                    <th>实际充值金额</th>
                    <th>到帐点数</th>
                    <th>备注</th>
                    <th>充值状态</th>
                    <th>创建时间</th>
                    <th>完成时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr class="{{
                        $item['status'] == \App\Models\Payment::STATUS_SUCCESS ? 'text-success' :
                        (
                            $item['status'] == \App\Models\Payment::STATUS_FAILED ? 'text-danger' : ''
                        )
                    }}">
                        <td>{{$item['payment_id']}}</td>
                        <td>{{$item['pay_channel_name']}}</td>
                        <td>{{$item['trade_no']}}</td>
                        <td>{{$item['money']}}</td>
                        <td>{{$item['actual_money']}}</td>
                        <td>{{$item['point']}}</td>
                        <td>{{$item['description']}}</td>
                        <td>{{$item['status_name']}}</td>
                        <td>{{$item['created_at']}}</td>
                        <td>{{$item['done_at']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="card-footer">
            <div class="text-center">
                {!! $data->render() !!}
            </div>
        </div>
    </div>


@endsection


@section('script')

    <script type="text/javascript">
        $().ready(function () {
            // Init DatetimePicker
            app.initFormExtendedDatetimepickers();
        });
    </script>

@endsection