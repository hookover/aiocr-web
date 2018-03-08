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
                        Developer
                    </h4>
                    <div class="category">
                        <a href="{{ url('/admin/developer/create') }}" class="btn btn-success btn-sm"
                           title="Add New developer">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/developer', 'class' => 'navbar-form', 'role' => 'search'])  !!}
                        <div class="form-group">
                            <input placeholder="请输入Developer Id" type="text" name="developer_id" class="form-control" value="{{ request('developer_id') }}">
                        </div>
                        <div class="form-group">
                            <input placeholder="请输入Email" type="text" name="email" class="form-control" value="{{ request('email') }}">
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
                                <th>Id</th>
                                <th>Developer Id</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Point Pay Total</th>
                                <th>Point Pay Current</th>
                                <th>Point Dividend Total</th>
                                <th>Point Dividend Current</th>
                                <th>Vip Point</th>
                                <th>Status Account</th>
                                <th>Count Login</th>
                                <th>Ip Last Login</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($developer as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->developer_id }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->point_pay_total }}</td>
                                    <td>{{ $item->point_pay_current }}</td>
                                    <td>{{ $item->point_dividend_total }}</td>
                                    <td>{{ $item->point_dividend_current }}</td>
                                    <td>{{ $item->vip_point }}</td>
                                    <td>{{ $item->status_account }}</td>
                                    <td>{{ $item->count_login }}</td>
                                    <td>{{ $item->ip_last_login }}</td>
                                    <td>{{ $item->time_last_login }}</td>
                                    <td>{{ $item->created }}</td>
                                    <td>
                                        <a href="{{ url('/admin/developer/' . $item->id) }}" title="View developer">
                                            <button class="btn btn-info btn-xs"><i class="fa fa-eye"
                                                                                   aria-hidden="true"></i> View
                                            </button>
                                        </a>
                                        <a href="{{ url('/admin/developer/' . $item->id . '/edit') }}"
                                           title="Edit developer">
                                            <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                                      aria-hidden="true"></i> Edit
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-center">
                        {!! $developer->appends(['developer_id' => Request::get('developer_id'), 'email' => Request::get('email'), 'date_from' => Request::get('date_from'), 'date_to' => Request::get('date_to')])->render() !!}
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