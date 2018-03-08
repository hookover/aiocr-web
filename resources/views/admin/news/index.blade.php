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
                        News
                    </h4>
                    <div class="category">
                        <a href="{{ url('/admin/news/create') }}" class="btn btn-success btn-sm" title="Add New news">
                                                    <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                                </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/admin/news', 'class' => 'navbar-form', 'role' => 'search'])  !!}
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
                                                            <th>#</th><th>Id</th><th>Category Id</th><th>Title</th><th>Keywords</th><th>Description</th><th>Admin Id</th><th>Slug</th><th>Status</th><th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($news as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration or $item->id }}</td>
                                                            <td>{{ $item->id }}</td><td>{{ $item->category_id }}</td><td>{{ $item->title }}</td><td>{{ $item->keywords }}</td><td>{{ $item->description }}</td><td>{{ $item->admin_id }}</td><td>{{ $item->slug }}</td><td>{{ $item->status }}</td>
                                                            <td>
                                                                <a href="{{ url('/admin/news/' . $item->id) }}" title="View news"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                                                <a href="{{ url('/admin/news/' . $item->id . '/edit') }}" title="Edit news"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                                                {!! Form::open([
                                                                    'method'=>'DELETE',
                                                                    'url' => ['/admin/news', $item->id],
                                                                    'style' => 'display:inline'
                                                                ]) !!}
                                                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                                            'type' => 'submit',
                                                                            'class' => 'btn btn-danger btn-xs',
                                                                            'title' => 'Delete news',
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
                        {!! $news->appends(['search' => Request::get('search')])->render() !!}
                    </div>
                </div>
            </div>  <!-- end card -->
        </div>
    </div>

@endsection



