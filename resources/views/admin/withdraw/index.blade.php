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
                        Withdraw
                    </h4>
                    <div class="category">
                        {{--<a href="{{ url('/admin/withdraw/create') }}" class="btn btn-success btn-sm"--}}
                           {{--title="Add New withdraw">--}}
                            {{--<i class="fa fa-plus" aria-hidden="true"></i> Add New--}}
                        {{--</a>--}}

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/withdraw', 'class' => 'navbar-form', 'role' => 'search'])  !!}
                        <div class="form-group">
                            <input placeholder="请输入UUID" type="text" name="uuid" class="form-control" value="{{ request('uuid') }}">
                        </div>
                        <div class="form-group">
                            <input placeholder="请输入Developer Id" type="text" name="developer_id" class="form-control" value="{{ request('developer_id') }}">
                        </div>
                        <div class="form-group">
                            <input placeholder="请输入Account" type="text" name="account" class="form-control" value="{{ request('account') }}">
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
                                <th>Id</th>
                                <th>Uuid</th>
                                <th>Developer Id</th>
                                <th>Channel Id</th>
                                <th>Real Name</th>
                                <th>Account</th>
                                <th>Money</th>
                                <th>Point</th>
                                <th>Point Before</th>
                                <th>Point After</th>
                                <th>Description</th>
                                <th>Admin Id</th>
                                <th>Status</th>
                                <th>Ip Created</th>
                                <th>Ip Admin</th>
                                <th>Done At</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($withdraw as $item)
                                <tr>
                                    <td>{{ $loop->iteration or $item->id }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->uuid }}</td>
                                    <td>{{ $item->developer_id }}</td>
                                    <td>{{ $item->channel_id }}</td>
                                    <td>{{ $item->real_name }}</td>
                                    <td>{{ $item->account }}</td>
                                    <td>{{ $item->money }}</td>
                                    <td>{{ $item->point }}</td>
                                    <td>{{ $item->point_before }}</td>
                                    <td>{{ $item->point_after }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->admin_id }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->ip_created }}</td>
                                    <td>{{ $item->ip_admin }}</td>
                                    <td>{{ $item->done_at }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a href="{{ url('/admin/withdraw/' . $item->id) }}" title="View withdraw">
                                            <button class="btn btn-info btn-xs"><i class="fa fa-eye"
                                                                                   aria-hidden="true"></i> View
                                            </button>
                                        </a>
                                        <a href="javascript:;" onclick="admin.withdrawAgree('/admin/withdraw/agree/{{$item->id}}')"
                                           title="Edit withdraw">
                                            <button class="btn btn-success btn-xs">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 审核通过
                                            </button>
                                        </a>
                                        <a href="javascript:;" onclick="admin.withdrawRefuse('/admin/withdraw/refuse/{{$item->id}}')"
                                           title="Edit withdraw">
                                            <button class="btn btn-danger btn-xs">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 驳回拒绝
                                            </button>
                                        </a>
                                        {{--<a href="{{ url('/admin/withdraw/' . $item->id . '/edit') }}"--}}
                                           {{--title="Edit withdraw">--}}
                                            {{--<button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"--}}
                                                                                      {{--aria-hidden="true"></i> Edit--}}
                                            {{--</button>--}}
                                        {{--</a>--}}
                                        {{--{!! Form::open([--}}
                                            {{--'method'=>'DELETE',--}}
                                            {{--'url' => ['/admin/withdraw', $item->id],--}}
                                            {{--'style' => 'display:inline'--}}
                                        {{--]) !!}--}}
                                        {{--{!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(--}}
                                                {{--'type' => 'submit',--}}
                                                {{--'class' => 'btn btn-danger btn-xs',--}}
                                                {{--'title' => 'Delete withdraw',--}}
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
                        {!! $withdraw->appends(['uuid' => Request::get('uuid'), 'developer_id' => Request::get('developer_id'), 'account' => Request::get('account'), 'date_from' => Request::get('date_from'), 'date_to' => Request::get('date_to')])->render() !!}
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