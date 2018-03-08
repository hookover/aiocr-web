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
                        Payment
                    </h4>
                    <div class="category">
                        <a class="btn btn-success btn-sm"
                           href="{{ url('/admin/payment/create') }}"
                           title="Add New payment">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/payment', 'class' => 'navbar-form', 'role' => 'search'])  !!}
                        <div class="form-group">
                            <input placeholder="请输入Payment Id" type="text" name="payment_id" class="form-control" value="{{ request('payment_id') }}">
                        </div>
                        <div class="form-group">
                            <input placeholder="请输入IP" type="text" name="ip" class="form-control" value="{{ request('ip') }}">
                        </div>
                        <div class="form-group">
                            <input placeholder="请输入UID" type="text" name="uid" class="form-control" value="{{ request('uid') }}">
                        </div>
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option value="">状态</option>
                                @foreach(\App\Models\Payment::$status as $key=>$value)
                                    <option value="{{ $key }}" {{ Request::get('status') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
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
                                <th>Payment Id</th>
                                <th>Pay Channel Id</th>
                                <th>Trade No</th>
                                <th>User Type</th>
                                <th>Uid</th>
                                <th>Money</th>
                                <th>Actual Money</th>
                                <th>Point</th>
                                <th>Point Before</th>
                                <th>Point After</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Ip</th>
                                <th>Done At</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payment as $item)
                                <tr class="{{ $item->status == \App\Models\Payment::STATUS_SUCCESS ? 'text-success' :
                                (($item->pay_channel_id == \App\Models\Payment::PAY_CHANNEL_ID_BANK && $item->status == \App\Models\Payment::STATUS_CREATED) ? 'text-warning' : '') }}">
                                    <td>{{ $loop->iteration or $item->id }}</td>
                                    <td>{{ $item->payment_id }}</td>
                                    <td>{{ $item->pay_channel_name }}</td>
                                    <td>{{ $item->trade_no }}</td>
                                    <td>{{ $item->user_type }}</td>
                                    <td>{{ $item->uid }}</td>
                                    <td>{{ number_format($item->money, 2, '.', ',') }}</td>
                                    <td>{{ number_format($item->actual_money, 2, '.', ',') }}</td>
                                    <td>{{ $item->point }}</td>
                                    <td>{{ $item->point_before }}</td>
                                    <td>{{ $item->point_after }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->status_name }}</td>
                                    <td>{{ $item->ip }}</td>
                                    <td>{{ $item->done_at }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a href="{{ url('/admin/payment/' . $item->id) }}" title="View payment">
                                            <button class="btn btn-info btn-xs"><i class="fa fa-eye"
                                                                                   aria-hidden="true"></i> View
                                            </button>
                                        </a>
                                        {{--<a href="{{ url('/admin/payment/' . $item->id . '/edit') }}"--}}
                                        {{--title="Edit payment">--}}
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
                        {!! $payment->appends(['payment_id' => Request::get('payment_id'), 'ip' => Request::get('ip'),'uid' => Request::get('uid'), 'status' => Request::get('status'), 'date_from' => Request::get('date_from'), 'date_to' => Request::get('date_to')])->render() !!}
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



