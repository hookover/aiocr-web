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
                        Admin
                    </h4>
                    <div class="category">
                        <a href="{{ url('/admin/admin/create') }}" class="btn btn-success btn-sm" title="Add New admin">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/admin', 'class' => 'navbar-form', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..."
                                   value="{{ request('search') }}">
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
                                <th>Admin Id</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Status Account</th>
                                <th>Count Login</th>
                                <th>Ip Last Login</th>
                                <th>Time Last Login</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admin as $item)
                                <tr>
                                    <td>{{ $loop->iteration or $item->id }}</td>
                                    <td>{{ $item->admin_id }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->status_account }}</td>
                                    <td>{{ $item->count_login }}</td>
                                    <td>{{ $item->ip_last_login }}</td>
                                    <td>{{ $item->time_last_login }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a href="{{ url('/admin/admin/' . $item->id) }}" title="View admin">
                                            <button class="btn btn-info btn-xs"><i class="fa fa-eye"
                                                                                   aria-hidden="true"></i> View
                                            </button>
                                        </a>
                                        {{--<a href="{{ url('/admin/admin/' . $item->id . '/edit') }}" title="Edit admin">--}}
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
                        {!! $admin->appends(['search' => Request::get('search')])->render() !!}
                    </div>
                </div>
            </div>  <!-- end card -->
        </div>
    </div>

@endsection



