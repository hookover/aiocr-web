@extends('layouts.backend')

@section('content')
    @if(Auth::user()->developer_id)
        <div class="card">
            <div class="card-content">
                <table id="bootstrap-table" class="table">
                    <thead>
                    <tr>
                        <th>记录时间</th>
                        <th>数量</th>
                        <th>积分</th>
                        <th>分成积分</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{date('Y-m-d H:i:s', $item['created_at'])}}</td>
                            <td>{{$item['number']}}</td>
                            <td>{{$item['points']}}</td>
                            <td>{{$item['dividend']}}</td>
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
    @endif

    @if(Auth::user()->user_id)
        <div class="card">
            <div class="card-content">
                <table id="bootstrap-table" class="table">
                    <thead>
                    <tr>
                        <th>记录时间</th>
                        <th>数量</th>
                        <th>积分</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{date('Y-m-d H:i:s', $item['created_at'])}}</td>
                            <td>{{$item['number']}}</td>
                            <td>{{$item['points']}}</td>
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
    @endif
@endsection