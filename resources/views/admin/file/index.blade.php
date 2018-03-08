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
                    <h4 class="card-title">
                        File
                    </h4>
                    <div class="category">
                        {{--<a href="{{ url('/admin/file/create') }}" class="btn btn-success btn-sm" title="Add New file">--}}
                            {{--<i class="fa fa-plus" aria-hidden="true"></i> Add New--}}
                        {{--</a>--}}

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/file', 'class' => 'navbar-form', 'role' => 'search'])  !!}
                        <div class="form-group">
                            <input placeholder="请输入Developer Id" type="text" name="developer_id" class="form-control" value="{{ request('developer_id') }}">
                        </div>
                        <div class="form-group">
                            <input placeholder="请输入User Id" type="text" name="user_id" class="form-control" value="{{ request('user_id') }}">
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<select name="status" class="form-control">--}}
                                {{--<option value="">识别状态</option>--}}
                                {{--@foreach(\App\Models\File::$status as $key=>$value)--}}
                                    {{--<option value="{{ $key }}">{{ $value }}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<select name="status" class="form-control">--}}
                                {{--<option value="">报错状态</option>--}}
                                {{--@foreach(\App\Models\File::$report_status as $key=>$value)--}}
                                    {{--<option value="{{ $key }}">{{ $value }}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                        <div class="form-group">
                            <input placeholder="开始时间" type="text" name="date_from" class="form-control datetimepicker" value="{{ request('date_from') }}">
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control datetimepicker" name="date_to" placeholder="结束时间"
                                   value="{{ request('date_to') }}">
                            <span class="input-group-btn">
                                                        <button class="btn btn-default" type="submit">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="card-content">
                    <div class="toolbar">

                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>id</th>
                                <th>Url</th>
                                <th>Status</th>
                                <th>Path</th>
                                <th>Report</th>
                                <th>Result</th>
                                <th>File Type Id</th>
                                <th>App Id</th>
                                <th>User Id</th>
                                <th>Developer Id</th>
                                <th>Cost</th>
                                <th>Ip</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($file as $item)
                                <tr>
                                    <td>{{ $loop->iteration or $item->id }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td><img src="{{ $item->url }}" alt=""></td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->path }}</td>
                                    <td>{{ $item->report }}</td>
                                    <td>{{ $item->result }}</td>
                                    <td>
                                        <a href="{{ route('file_type.index', ['file_type_id'=>$item->file_type_id]) }}">{{ $item->file_type_id }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('app.index', ['app_id'=>$item->app_id]) }}">{{ $item->app_id }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('user.index', ['user_id'=>$item->user_id]) }}">{{ $item->user_id }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('developer.index', ['developer_id'=>$item->developer_id]) }}">{{ $item->developer_id }}</a>
                                    </td>
                                    <td>{{ $item->cost }}</td>
                                    <td>{{ $item->ip }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a href="{{ url('/admin/file/' . $item->id) }}" title="View file">
                                            <button class="btn btn-info btn-xs"><i class="fa fa-eye"
                                                                                   aria-hidden="true"></i> View
                                            </button>
                                        </a>
                                        {{--<a href="{{ url('/admin/file/' . $item->id . '/edit') }}" title="Edit file">--}}
                                            {{--<button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"--}}
                                                                                      {{--aria-hidden="true"></i> Edit--}}
                                            {{--</button>--}}
                                        {{--</a>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-center">
                        {!! $file->appends(['developer_id' => Request::get('developer_id'), 'user_id' => Request::get('user_id'), 'date_from' => Request::get('date_from'), 'date_to' => Request::get('date_to')])->render() !!}
                    </div>
                </div>
            </div>  <!-- end card -->
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