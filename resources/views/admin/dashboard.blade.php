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
                                        {{Auth::user()->ip_pre_login}}
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
                                        {{Auth::user()->ip_last_login}}
                                    </p>
                                </div>
                            </div>

                        </div>


                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">未处理提现申请数量</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static text-danger">
                                        <a href="{{ route('withdraw.index') }}">{{ $data['withdraw_count'] }}</a>
                                    </p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-4 control-label">24小时内注册用户数量</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static">
                                        <a href="{{ route('user.index') }}">{{ $data['user_count'] }}</a>
                                    </p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-4 control-label">24小时内注册开发者数量</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static">
                                        <a href="{{ route('developer.index') }}">{{ $data['developer_count'] }}</a>
                                    </p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-4 control-label">24小时内充值金额合计</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static">
                                        <a href="{{ route('payment.index') }}">{{ $data['money_total'] }}</a>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 control-label">24小时内实充值金额合计</label>
                                <div class="col-lg-8">
                                    <p class="form-control-static">
                                        <a href="{{ route('payment.index') }}">{{ $data['money_actual_total'] }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>  <!-- end card -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">识别统计信息</h4>
                </div>
                <div class="card-content ">
                    <div id="main" class="ct-chart" style="width: 100%;height:400px;"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">

        $.ajax({
            url: '/admin/statistics',
            type: 'get',
            dataType: 'json',
            success: function (response) {
                var v_time = [];
                var v_number = [];
                var v_points = [];
                if(response.data != ''){
                    for(var n in response.data){
                        var h_time = new Date(n*1000)
                        v_time.push(h_time.getHours() + '点');
                        v_number.push(response.data[n].numbers);
                        v_points.push(response.data[n].points);
                    }
                }else{
                    v_time[0]   = 0;
                    v_number[0] = 0;
                    v_points[0] = 0;
                }
                var myChart = echarts.init(document.getElementById('main'));

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
@endsection