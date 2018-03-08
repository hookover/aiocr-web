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
                        Edit user_log #{{ $user_log->id }}
                    </h4>
                    <p class="category">
                        <a href="{{ url('/admin/user_log') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    </p>
                </div>
                <div class="card-content">

                    {!! Form::model($user_log, [
                                                'method' => 'PATCH',
                                                'url' => ['/admin/user_log', $user_log->id],
                                                'class' => 'form-horizontal',
                                                'files' => true
                                            ]) !!}

                                            @include ('admin.user_log.form', ['submitButtonText' => 'Update'])

                                            {!! Form::close() !!}
                </div>
            </div>  <!-- end card -->
        </div>
    </div>

@endsection
