@extends('layouts.backend')


@section('content')
    {{--'user_id', 'card', 'point', 'money', 'status', 'updated_at'--}}
    <div class="card">
        <div class="card-content">
            <div class="toolbar">
                <!--Here you can write extra buttons/actions for the toolbar-->
            </div>
            <table id="bootstrap-table" class="table">
                <thead>
                <tr>
                    <th>提现单号</th>
                    <th>提现渠道</th>
                    <th>提现帐户</th>
                    <th>提现金额</th>
                    <th>提现点数</th>
                    <th>备注</th>
                    <th>状态</th>
                    <th>申请时间</th>
                    <th>完成时间</th>
                </tr>
                </thead>
                <tbody>
                {{--'uuid', 'pay_channel_id', 'trade_no',--}}
                {{--'money', 'actual_money', 'point', 'description',--}}
                {{--'status', 'updated_at', 'created_at',--}}
                @foreach($data as $item)
                    <tr>
                        <td>{{$item['uuid']}}</td>
                        <td>{{$item['channel_name']}}</td>
                        <td>{{$item['account']}}</td>
                        <td>{{$item['money']}}</td>
                        <td>{{$item['point']}}</td>
                        <td>{{$item['description']}}</td>
                        <td>{{$item['status']}}</td>
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

@endsection