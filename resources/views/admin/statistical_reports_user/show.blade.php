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
                        statistical_reports_user {{ $statistical_reports_user->id }}
                    </h4>
                    <div class="category">
                       <a href="{{ url('/admin/statistical_reports_user') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                                               <a href="{{ url('/admin/statistical_reports_user/' . $statistical_reports_user->id . '/edit') }}" title="Edit statistical_reports_user"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                               {!! Form::open([
                                                   'method'=>'DELETE',
                                                   'url' => ['admin/statistical_reports_user', $statistical_reports_user->id],
                                                   'style' => 'display:inline'
                                               ]) !!}
                                                   {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                           'type' => 'submit',
                                                           'class' => 'btn btn-danger btn-xs',
                                                           'title' => 'Delete statistical_reports_user',
                                                           'onclick'=>'return confirm("Confirm delete?")'
                                                   ))!!}
                                               {!! Form::close() !!}
                    </div>
                </div>
                <div class="card-content">
                                    <div class="form-horizontal row">
                                        <div class="col-lg-6">

                                            @foreach($statistical_reports_user->toArray() as $key=>$value)

                                                <div class="form-group">
                                                    <label class="col-lg-4 control-label">{{$key}}</label>
                                                    <div class="col-lg-8">
                                                        <p class="form-control-static">
                                                            {{ $value }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>


                                    </div>
                                </div>

            </div>  <!-- end card -->
        </div>
    </div>

@endsection
