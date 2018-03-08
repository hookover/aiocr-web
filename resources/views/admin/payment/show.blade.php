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
                        payment {{ $payment->id }}
                    </h4>
                    <div class="category">
                       <a href="{{ url('/admin/payment') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>

                        @if($payment->pay_channel_id == \App\Models\Payment::PAY_CHANNEL_ID_BANK && $payment->status == \App\Models\Payment::STATUS_CREATED)
                        <a href="{{ url('/admin/payment/' . $payment->id . '/edit') }}">

                        </a>
                            <div class="mt30 text-center">
                                <button class="btn btn-success" onclick="admin.confirmBankTransfer('{{route('confirm-bank')}}','{{ $payment->payment_id }}','pass')"><i class="fa fa-check" aria-hidden="true"></i> 确认已收到款项，为用户充值积分</button>
                                <button class="btn btn-danger" onclick="admin.confirmBankTransfer('{{route('confirm-bank')}}','{{ $payment->payment_id }}','refusal')"><i class="fa fa-close" aria-hidden="true"></i> 审核失败，驳回用户转款单</button>
                                <hr>
                            </div>
                        @endif

                    </div>
                </div>
                <div class="card-content">
                                    <div class="form-horizontal row">
                                        <div class="col-lg-6">

                                            @foreach($payment->toArray() as $key=>$value)

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
