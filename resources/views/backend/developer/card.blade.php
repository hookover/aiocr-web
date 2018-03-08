@extends('layouts.backend')


@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">生成充值卡</h4>
            <p class="category"></p>
        </div>
        <div class="card-content">
            <form class="form-horizontal" method="post" action="{{ route('create-card') }}">

                {{ csrf_field() }}

                <fieldset>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">可用户于生成充值卡的点数</label>
                        <div class="col-lg-5">
                            <p class="form-control-static">
                                {{ Auth::user()->point_pay_current + Auth::user()->point_dividend_current }}

                                ≈

                                {{ (Auth::user()->point_pay_current + Auth::user()->point_dividend_current) / env('MONEY_TO_POINT_PAY') }}元
                            </p>
                            <span class="help-block">
                                兑换比例：1元={{ env('MONEY_TO_POINT_PAY') }}积分
                            </span>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">生成数量</label>
                        <div class="col-lg-5">
                            <input type="number" name="number" value="10" class="form-control">
                            @if ($errors->has('number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('number') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">充值卡面额</label>
                        <div class="col-lg-5">
                            <select class="form-control" name="card_money" title="请选择充值卡类型" data-size="7" tabindex="-98">
                                <option value="1">1元</option>
                                <option value="10">10元</option>
                                <option value="50">50元</option>
                                <option value="100" selected>100元</option>
                                <option value="200">200元</option>
                                <option value="500">500元</option>
                                <option value="1000">1000元</option>
                                <option value="2000">2000元</option>
                                <option value="5000">5000元</option>
                                <option value="10000">10000元</option>
                            </select>

                            @if ($errors->has('card_money'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('card_money') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label class="col-lg-2 control-label"></label>
                        <div class="col-lg-9 text-left">
                            <button type="submit" class="btn btn-info btn-fill btn-wd">立即生成</button>
                        </div>
                    </div>
                </fieldset>
            </>
        </div>
    </div>

    {{--'user_id', 'card', 'point', 'money', 'status', 'updated_at'--}}
    <div class="card">
        <div class="card-content">
            <div class="toolbar">
                <!--Here you can write extra buttons/actions for the toolbar-->
                <div class="text-right">
                    <a target="_blank" href="{{ route('export-card') }}" class="btn"><i class="ti-download"></i> 导出全部</a>
                    <a target="_blank" href="{{ route('export-card', ['status'=>App\Models\Card::CARD_VALID]) }}" class="btn"><i class="ti-download"></i> 导出未使用</a>
                    <a target="_blank" href="{{ route('export-card', ['status'=>App\Models\Card::CARD_IS_USED]) }}" class="btn"><i class="ti-download"></i> 导出已使用</a>
                </div>
            </div>
            <table id="bootstrap-table" class="table">
                <thead>
                <tr>
                    <th>卡号</th>
                    <th>点数</th>
                    <th>面额</th>
                    <th>状态</th>
                    <th>生成时间</th>
                    <th>使用人ID</th>
                    <th>使用时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{$item['card']}}</td>
                        <td>{{$item['point']}}</td>
                        <td>{{$item['money']}}</td>
                        <td>{{$item['status_name']}}</td>
                        <td>{{$item['created_at']}}</td>
                        <td>{{$item['user_id']}}</td>
                        <td>{{$item['time_used']}}</td>
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

@endsection