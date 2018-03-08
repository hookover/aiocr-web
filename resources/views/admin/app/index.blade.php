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
                        App
                    </h4>
                    <div class="category">
                        <a href="{{ url('/admin/app/create') }}" class="btn btn-success btn-sm" title="Add New app">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/app', 'class' => 'navbar-form', 'role' => 'search'])  !!}
                        <div class="form-group">
                            <input placeholder="请输入App Id" type="text" name="app_id" class="form-control" value="{{ request('app_id') }}">
                        </div>
                        <div class="form-group">
                            <input placeholder="请输入Developer Id" type="text" name="developer_id" class="form-control" value="{{ request('developer_id') }}">
                        </div>
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
                                <th>App Id</th>
                                <th>App Key</th>
                                <th>Developer Id</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Developer Id Created</th>
                                <th>Ip</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($app as $item)
                                <tr>
                                    <td>{{ $loop->iteration or $item->id }}</td>
                                    <td>{{ $item->app_id }}</td>
                                    <td>{{ $item->app_key }}</td>
                                    <td><a href="{{ route('developer.index', ['developer_id'=>$item->developer_id]) }}">{{ $item->developer_id }}</a></td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->developer_id_created }}</td>
                                    <td>{{ $item->ip }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a href="{{ url('/admin/app/' . $item->id) }}" title="View app">
                                            <button class="btn btn-info btn-xs"><i class="fa fa-eye"
                                                                                   aria-hidden="true"></i> View
                                            </button>
                                        </a>
                                        <a href="{{ url('/admin/app/' . $item->id . '/edit') }}" title="Edit app">
                                            <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                                      aria-hidden="true"></i> Edit
                                            </button>
                                        </a>
                                        {{--{!! Form::open([--}}
                                            {{--'method'=>'DELETE',--}}
                                            {{--'url' => ['/admin/app', $item->id],--}}
                                            {{--'style' => 'display:inline'--}}
                                        {{--]) !!}--}}
                                        {{--{!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(--}}
                                                {{--'type' => 'submit',--}}
                                                {{--'class' => 'btn btn-danger btn-xs',--}}
                                                {{--'title' => 'Delete app',--}}
                                                {{--'onclick'=>'return confirm("Confirm delete?")'--}}
                                        {{--)) !!}--}}
                                        {{--{!! Form::close() !!}--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-center">
                        {!! $app->appends(['app_id' => Request::get('app_id'), 'developer_id' => Request::get('developer_id'), 'date_from' => Request::get('date_from'), 'date_to' => Request::get('date_to')])->render() !!}
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