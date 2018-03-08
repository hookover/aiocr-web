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
                        Card
                    </h4>
                    <div class="category">
                        {{--<a href="{{ url('/admin/card/create') }}" class="btn btn-success btn-sm" title="Add New card">--}}
                            {{--<i class="fa fa-plus" aria-hidden="true"></i> Add New--}}
                        {{--</a>--}}

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/card', 'class' => 'navbar-form', 'role' => 'search'])  !!}
                        <div class="form-group">
                            <input placeholder="请输入Developer Id" type="text" name="developer_id" class="form-control" value="{{ request('developer_id') }}">
                        </div>
                        <div class="form-group">
                            <input placeholder="请输入User Id" type="text" name="user_id" class="form-control" value="{{ request('user_id') }}">
                        </div>
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option value="">状态</option>
                                @foreach(\App\Models\Card::$status as $key=>$value)
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
                                <th>Id</th>
                                <th>Developer Id</th>
                                <th>User Id</th>
                                <th>Point Before</th>
                                <th>Point After</th>
                                <th>Card</th>
                                <th>Point</th>
                                <th>Money</th>
                                <th>Ip Used</th>
                                <th>Ip Created</th>
                                <th>Status</th>
                                <th>Time Used</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($card as $item)
                                <tr>
                                    <td>{{ $loop->iteration or $item->id }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td><a href="{{ route('developer.index', ['developer_id'=>$item->developer_id]) }}">{{ $item->developer_id }}</a></td>
                                    <td><a href="{{ route('user.index', ['user_id'=>$item->user_id]) }}">{{ $item->user_id }}</a></td>
                                    <td>{{ $item->point_before }}</td>
                                    <td>{{ $item->point_after }}</td>
                                    <td>{{ $item->card }}</td>
                                    <td>{{ $item->point }}</td>
                                    <td>{{ $item->money }}</td>
                                    <td>{{ $item->ip_used }}</td>
                                    <td>{{ $item->ip_created }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->time_used }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <a href="{{ url('/admin/card/' . $item->id) }}" title="View card">
                                            <button class="btn btn-info btn-xs"><i class="fa fa-eye"
                                                                                   aria-hidden="true"></i> View
                                            </button>
                                        </a>
                                        <a href="{{ url('/admin/card/' . $item->id . '/edit') }}" title="Edit card">
                                            <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                                      aria-hidden="true"></i> Edit
                                            </button>
                                        </a>
                                        {{--{!! Form::open([--}}
                                            {{--'method'=>'DELETE',--}}
                                            {{--'url' => ['/admin/card', $item->id],--}}
                                            {{--'style' => 'display:inline'--}}
                                        {{--]) !!}--}}
                                        {{--{!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(--}}
                                                {{--'type' => 'submit',--}}
                                                {{--'class' => 'btn btn-danger btn-xs',--}}
                                                {{--'title' => 'Delete card',--}}
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
                        {!! $card->appends(['developer_id' => Request::get('developer_id'), 'user_id' => Request::get('user_id'), 'status' => Request::get('status'), 'date_from' => Request::get('date_from'), 'date_to' => Request::get('date_to')])->render() !!}
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


