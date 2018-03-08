@extends('layouts.backend')


@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-content">
                    <div class="toolbar">
                        <!--Here you can write extra buttons/actions for the toolbar-->
                    </div>
                    <table id="bootstrap-table" class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>图片</th>
                            <th>状态</th>
                            <th>识别结果</th>
                            <th>类型ID</th>
                            <th>AppID</th>
                            <th>积分</th>
                            <th>上传时间/耗时</th>
                            <th>ip</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr class="{{ $item['report'] == \App\Models\File::REPORT_STATUS_YES ? 'text-danger' : '' }}">
                                <td>{{$item['id']}}</td>
                                <td><img class="decode-img" src="{{$item['url']}}" alt=""></td>
                                <td>{{$item['status_name']}}</td>
                                <td>{{$item['result']}}</td>
                                <td>{{$item['file_type_id']}}</td>
                                <td>{{$item['app_id']}}</td>
                                <td>{{$item['cost']}}</td>
                                <td data-toggle="tooltip"
                                    data-placement="top"
                                    title="耗时：{{strtotime($item['updated_at']) - strtotime($item['created_at'])}} 秒"
                                    class="{{ (strtotime($item['updated_at']) - strtotime($item['created_at'])) > 1 ? 'text-warning' : '' }}">
                                    {{$item['updated_at']}}
                                </td>
                                <td>{{$item['ip']}}</td>
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

        </div>
    </div>

@endsection