@extends('layouts.backend')


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        基本信息
                    </h4>
                </div>
                <div class="card-content">
                    <div class="form-horizontal row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">当前账户</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static">
                                        {{Auth::user()->email}}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-4 control-label">上次登录IP</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static">
                                        {{ long2ip(Auth::user()->ip_pre_login) }}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-4 control-label">上次登录时间</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static">
                                        {{Auth::user()->time_pre_login}}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-4 control-label">当前登录IP</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static">
                                        {{ long2ip(Auth::user()->ip_last_login) }}
                                    </p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-4 control-label">账户剩余充值点数</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static">
                                        {{Auth::user()->point_pay_current}}

                                        @if(Auth::user()->user_id)
                                            <span class="ml15">
                                                <a href="javascript:void(0)" onclick="app.showSwal('lock_point')">锁定积分</a>
                                                <a href="{{route('payment-user')}}">立即充值</a>
                                            </span>
                                        @endif

                                        @if(Auth::user()->developer_id)
                                            <span class="ml15">
                                                <a href="{{ route('card-developer') }}">生成充值卡</a>
                                                <a href="{{ route('payment-developer') }}">立即充值</a>
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            @if(Auth::user()->user_id)
                                <div class="form-group">
                                    <label class="col-lg-4 control-label">已锁定点数</label>
                                    <div class="col-lg-8">
                                        <p class="form-control-static">
                                            {{Auth::user()->point_locked}}
                                            <span class="ml15">
                                                <a href="javascript:void(0)" onclick="app.showSwal('unlock_point')">解锁积分</a>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            @endif

                            @if(Auth::user()->developer_id)
                                <div class="form-group">
                                    <label class="col-lg-4 control-label">账户可提现点数</label>
                                    <div class="col-lg-8">
                                        <p class="form-control-static">
                                            {{Auth::user()->point_dividend_current}}

                                            ≈

                                            {{ Auth::user()->point_dividend_current / env('MONEY_TO_POINT_WITHDRAW') }}元

                                            <span class="ml15">

                                            <a href="javascript:void(0)" onclick="app.withdraw({{ env('DEVELOPER_WITHDRAW',50) }})">申请提现</a>
                                            </span>
                                        </p>
                                        <span class="help-block">
                                            满{{ env('DEVELOPER_WITHDRAW',50) }}元方可申请提现，提现后2个工作日内到账<br/>
                                            当前支持的提现渠道为：<span class="text-info">[ {{ env('WITHDRAW_CHANNEL_NAME', '渠道未配置') }} ]</span> ，提现前请确认已
                                            <a href="{{ route('withdraw-account-developer') }}">[ 补全 ] </a>收款人信息

                                        </span>
                                    </div>
                                </div>
                            @endif

                        </div>

                        <div class="col-lg-6">
                            @if(Auth::user()->user_id)
                                <div class="form-group">
                                    <label class="col-lg-4 control-label">安全功能</label>
                                    <div class="col-lg-8">
                                        <p class="form-control-static">
                                            当前通信密钥生成于{{ round((time() - strtotime(Auth::user()->api_token_created_at)) / 86400, 2) }}天前
                                            <span class="ml15">
                                                <a href="{{ route('reset-token-user') }}">立即重置</a>
                                            </span>
                                        </p>
                                        <span class="help-block">
                                            注意：若怀疑有人盗用您的账户，可以通过重置密钥来立即禁止以前生成的通信key。<br/>
                                            重置后正在进行的识别任务将会被立即停止，需要您重新在软件上登录方可继续使用
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>  <!-- end card -->
        </div>
    </div>

    @if(Auth::user()->user_id)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">识别统计信息</h4>
                    </div>
                    <div class="card-content">
                        <div id="main-user" class="ct-chart" style="width: 100%;height:400px;"></div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(Auth::user()->developer_id)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">识别统计信息</h4>
                    </div>
                    <div class="card-content">
                        <div id="main-developer" class="ct-chart" style="width: 100%;height:400px;"></div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@section('script')
    @if(Auth::user()->user_id)
        <script type="text/javascript">
            $.ajax({
                url: '/user/statistics',
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    var v_time = [];
                    var v_number = [];
                    var v_points = [];
                    if(response.data != ''){
                        for(var n in response.data){
                            var h_time = new Date(n*1000);
                            v_time.push(h_time.getDate()+'日');
                            v_number.push(response.data[n].numbers);
                            v_points.push(response.data[n].points);
                        }
                    }else{
                        v_time[0]   =0;
                        v_number[0] =0;
                        v_points[0] =0;
                    }
                    var myChart = echarts.init(document.getElementById('main-user'));

                    option = {
                        tooltip : {
                            trigger: 'axis'
                        },
                        legend: {
                            data:['数量统计','积分统计']
                        },
                        toolbox: {
                            show : true,
                            feature : {
                                mark : {show: true},
                                dataView : {show: true, readOnly: false},
                                magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
                                restore : {show: true},
                                saveAsImage : {show: true}
                            },
                            top: '20'
                        },
                        calculable : true,
                        xAxis : [
                            {
                                type : 'category',
                                boundaryGap : false,
                                data : v_time
                            }
                        ],
                        yAxis : [
                            {
                                type : 'value'
                            }
                        ],
                        series : [
                            {
                                name:'数量统计',
                                type:'line',
                                stack: '总量',
                                data: v_number
                            },
                            {
                                name:'积分统计',
                                type:'line',
                                stack: '总量',
                                data: v_points
                            }
                        ]
                    };

                    myChart.setOption(option);
                }
            })
        </script>
    @endif

    @if(Auth::user()->developer_id)
        <script type="text/javascript">

            $.ajax({
                url: '/developer/statistics',
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    var v_time = [];
                    var v_number = [];
                    var v_points = [];
                    var v_dividend = [];
                    if(response.data != ''){
                        for(var n in response.data){
                            var h_time = new Date(n*1000);
                            v_time.push(h_time.getDate()+'日');
                            v_number.push(response.data[n].numbers);
                            v_points.push(response.data[n].points);
                            v_dividend.push(response.data[n].dividend);
                        }
                    }else{
                        v_time[0]      =0;
                        v_number[0]    =0;
                        v_points[0]    =0;
                        v_dividend[0]  =0;
                    }
                    var myChart = echarts.init(document.getElementById('main-developer'));

                    option = {
                        tooltip : {
                            trigger: 'axis'
                        },
                        legend: {
                            data:['数量统计','积分统计','分成积分统计']
                        },
                        toolbox: {
                            show : true,
                            feature : {
                                mark : {show: true},
                                dataView : {show: true, readOnly: false},
                                magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
                                restore : {show: true},
                                saveAsImage : {show: true}
                            },
                            top: '20'
                        },
                        calculable : true,
                        xAxis : [
                            {
                                type : 'category',
                                boundaryGap : false,
                                data : v_time
                            }
                        ],
                        yAxis : [
                            {
                                type : 'value'
                            }
                        ],
                        series : [
                            {
                                name:'数量统计',
                                type:'line',
                                stack: '总量',
                                data: v_number
                            },
                            {
                                name:'积分统计',
                                type:'line',
                                stack: '总量',
                                data: v_points
                            },
                            {
                                name:'分成积分统计',
                                type:'line',
                                stack: '总量',
                                data: v_dividend
                            }
                        ]
                    };

                    myChart.setOption(option);
                }
            })
        </script>
    @endif

@endsection