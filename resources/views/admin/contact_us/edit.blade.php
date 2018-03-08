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
                        Edit contact_us #{{ $contact_us->id }}
                    </h4>
                    <p class="category">
                        <a href="{{ url('/admin/contact_us') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    </p>
                </div>
                <div class="card-content">

                    {!! Form::model($contact_us, [
                                                'method' => 'PATCH',
                                                'url' => ['/admin/contact_us', $contact_us->id],
                                                'class' => 'form-horizontal',
                                                'files' => true
                                            ]) !!}

                                            @include ('admin.contact_us.form', ['submitButtonText' => 'Update'])

                                            {!! Form::close() !!}
                </div>
            </div>  <!-- end card -->
        </div>
    </div>

@endsection
