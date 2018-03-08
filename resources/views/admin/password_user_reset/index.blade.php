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
                        Password_user_reset
                    </h4>
                    <div class="category">
                        {{--<a href="{{ url('/admin/password_user_reset/create') }}" class="btn btn-success btn-sm" title="Add New password_user_reset">--}}
                                                    {{--<i class="fa fa-plus" aria-hidden="true"></i> Add New--}}
                                                {{--</a>--}}

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/password_user_reset', 'class' => 'navbar-form', 'role' => 'search'])  !!}
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
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
                                                            <th>#</th><th>Email</th><th>Token</th><th>Created At</th>
                                                            {{--<th>Actions</th>--}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($password_user_reset as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration or $item->id }}</td>
                                                            <td>{{ $item->email }}</td><td>{{ $item->token }}</td><td>{{ $item->created_at }}</td>
                                                            <td>
                                                                {{--<a href="{{ url('/admin/password_user_reset/' . $item->id) }}" title="View password_user_reset"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>--}}
                                                                {{--<a href="{{ url('/admin/password_user_reset/' . $item->id . '/edit') }}" title="Edit password_user_reset"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>--}}
                                                                {{--{!! Form::open([--}}
                                                                    {{--'method'=>'DELETE',--}}
                                                                    {{--'url' => ['/admin/password_user_reset', $item->id],--}}
                                                                    {{--'style' => 'display:inline'--}}
                                                                {{--]) !!}--}}
                                                                    {{--{!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(--}}
                                                                            {{--'type' => 'submit',--}}
                                                                            {{--'class' => 'btn btn-danger btn-xs',--}}
                                                                            {{--'title' => 'Delete password_user_reset',--}}
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
                        {!! $password_user_reset->appends(['search' => Request::get('search')])->render() !!}
                    </div>
                </div>
            </div>  <!-- end card -->
        </div>
    </div>

@endsection



