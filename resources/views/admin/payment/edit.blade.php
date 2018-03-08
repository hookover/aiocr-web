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
                        Edit payment #{{ $payment->id }}
                    </h4>
                    <p class="category">
                        <a href="{{ url('/admin/payment') }}" title="Back">
                            <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                    </p>
                </div>
                <div class="card-content">

                    {!! Form::model($payment, [
                                                'method' => 'PATCH',
                                                'url' => ['/admin/payment', $payment->id],
                                                'class' => 'form-horizontal',
                                                'files' => true
                                            ]) !!}

                    @include ('admin.payment.form', ['submitButtonText' => 'Update'])

                    {!! Form::close() !!}
                </div>
            </div>  <!-- end card -->
        </div>
    </div>

@endsection
