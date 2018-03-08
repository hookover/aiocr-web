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
                        Contact_us
                    </h4>
                    <div class="category">
                        <a href="{{ url('/admin/contact_us/create') }}" class="btn btn-success btn-sm" title="Add New contact_us">
                                                    <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                                </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/contact_us', 'class' => 'navbar-form', 'role' => 'search'])  !!}
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
                                                            <th>#</th><th>Id</th><th>Name</th><th>Email</th><th>Phone</th><th>Wechat</th><th>Content</th><th>Created At</th><th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($contact_us as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration or $item->id }}</td>
                                                            <td>{{ $item->id }}</td><td>{{ $item->name }}</td><td>{{ $item->email }}</td><td>{{ $item->phone }}</td><td>{{ $item->wechat }}</td><td>{{ $item->content }}</td><td>{{ $item->created_at }}</td>
                                                            <td>
                                                                <a href="{{ url('/admin/contact_us/' . $item->id) }}" title="View contact_us"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                                                <a href="{{ url('/admin/contact_us/' . $item->id . '/edit') }}" title="Edit contact_us"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                                                {!! Form::open([
                                                                    'method'=>'DELETE',
                                                                    'url' => ['/admin/contact_us', $item->id],
                                                                    'style' => 'display:inline'
                                                                ]) !!}
                                                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                                            'type' => 'submit',
                                                                            'class' => 'btn btn-danger btn-xs',
                                                                            'title' => 'Delete contact_us',
                                                                            'onclick'=>'return confirm("Confirm delete?")'
                                                                    )) !!}
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
                        {!! $contact_us->appends(['search' => Request::get('search')])->render() !!}
                    </div>
                </div>
            </div>  <!-- end card -->
        </div>
    </div>

@endsection



