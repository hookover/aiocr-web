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
                        Statistical_reports_admin
                    </h4>
                    <div class="category">
                        {{--<a href="{{ url('/admin/statistical_reports_admin/create') }}" class="btn btn-success btn-sm" title="Add New statistical_reports_admin">--}}
                                                    {{--<i class="fa fa-plus" aria-hidden="true"></i> Add New--}}
                                                {{--</a>--}}

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/statistical_reports_admin', 'class' => 'navbar-form', 'role' => 'search'])  !!}
                            <div class="form-group">
                                <input placeholder="开始时间" type="text" name="date_from" class="form-control datetimepicker" value="{{ request('date_from') }}">
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control datetimepicker" name="date_to" placeholder="结束时间" value="{{ request('date_to') }}">
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
                                                            <th>#</th><th>Created At</th><th>Number</th><th>Points</th>
                                                            {{--<th>Actions</th>--}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($statistical_reports_admin as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration or $item->id }}</td>
                                                            <td>{{ date('Y-m-d H:i:s', $item->created_at) }}</td><td>{{ $item->number }}</td><td>{{ $item->points }}</td>
                                                            <td>
                                                                {{--<a href="{{ url('/admin/statistical_reports_admin/' . $item->id) }}" title="View statistical_reports_admin"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>--}}
                                                                {{--<a href="{{ url('/admin/statistical_reports_admin/' . $item->id . '/edit') }}" title="Edit statistical_reports_admin"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>--}}
                                                                {{--{!! Form::open([--}}
                                                                    {{--'method'=>'DELETE',--}}
                                                                    {{--'url' => ['/admin/statistical_reports_admin', $item->id],--}}
                                                                    {{--'style' => 'display:inline'--}}
                                                                {{--]) !!}--}}
                                                                    {{--{!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(--}}
                                                                            {{--'type' => 'submit',--}}
                                                                            {{--'class' => 'btn btn-danger btn-xs',--}}
                                                                            {{--'title' => 'Delete statistical_reports_admin',--}}
                                                                            {{--'onclick'=>'return confirm("Confirm delete?")'--}}
                                                                    {{--)) !!}--}}
                                                                {!! Form::close() !!}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-center">
                        {!! $statistical_reports_admin->appends(['date_from' => Request::get('date_from'), 'date_to' => Request::get('date_to')])->render() !!}
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