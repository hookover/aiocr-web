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
                        File_type
                    </h4>
                    <div class="category">
                        <a href="{{ url('/admin/file_type/create') }}" class="btn btn-success btn-sm" title="Add New file_type">
                                                    <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                                </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/file_type', 'class' => 'navbar-form', 'role' => 'search'])  !!}
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
                                                            <th>#</th><th>Id</th><th>File Type Id</th><th>Cost</th><th>Length</th><th>Name</th><th>Description</th><th>Ai Enable</th><th>Status</th><th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($file_type as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration or $item->id }}</td>
                                                            <td>{{ $item->id }}</td><td>{{ $item->file_type_id }}</td><td>{{ $item->cost }}</td><td>{{ $item->length }}</td><td>{{ $item->name }}</td><td>{{ $item->description }}</td><td>{{ $item->ai_enable }}</td><td>{{ $item->status }}</td>
                                                            <td>
                                                                <a href="{{ url('/admin/file_type/' . $item->id) }}" title="View file_type"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                                                <a href="{{ url('/admin/file_type/' . $item->id . '/edit') }}" title="Edit file_type"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                                                {!! Form::open([
                                                                    'method'=>'DELETE',
                                                                    'url' => ['/admin/file_type', $item->id],
                                                                    'style' => 'display:inline'
                                                                ]) !!}
                                                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                                            'type' => 'submit',
                                                                            'class' => 'btn btn-danger btn-xs',
                                                                            'title' => 'Delete file_type',
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
                        {!! $file_type->appends(['search' => Request::get('search')])->render() !!}
                    </div>
                </div>
            </div>  <!-- end card -->
        </div>
    </div>

@endsection



