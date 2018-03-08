@extends('layouts.backend')


@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">创建App</h4>
            <p class="category"></p>
        </div>
        <div class="card-content">
            <form class="form-horizontal" method="post" action="{{ route('create-app') }}">

                {{ csrf_field() }}

                <fieldset>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">新的App名称</label>
                        <div class="col-lg-5">
                            <input type="text" name="app_name" class="form-control">
                            @if ($errors->has('app_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('app_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label class="col-lg-2 control-label"></label>
                        <div class="col-lg-9 text-left">
                            <button type="submit" class="btn btn-info btn-fill btn-wd">立即创建</button>
                        </div>
                    </div>
                </fieldset>

            </form>
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
                    <th>APP ID</th>
                    <th>APP KEY</th>
                    <th>APP名称</th>
                    <th>状态</th>
                    <th>创建时间</th>
                    <th>操作项</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{$item['app_id']}}</td>
                        <td>{{$item['app_key']}}</td>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['status']}}</td>
                        <td>{{$item['created_at']}}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="app.alertError('该功能尚未开放～')">删除</a>
                        </td>
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