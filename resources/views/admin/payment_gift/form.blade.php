<div class="form-group {{ $errors->has('condition_money') ? 'has-error' : ''}}">
    {!! Form::label('condition_money', 'Condition Money', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('condition_money', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('condition_money', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('gift_money') ? 'has-error' : ''}}">
    {!! Form::label('gift_money', 'Gift Money', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('gift_money', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('gift_money', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        @foreach(\App\Models\PaymentGift::$status as $value=>$name)
            <div class="radio">
                <input type="radio" name="status" id="{{ 'status' . $value }}"
                       value="{{ $value }}" {{ isset($payment_gift) && ( $value == $payment_gift->status) ? 'checked="checked"' : '' }}>
                <label for="{{ 'status' . $value }}">
                    {{ $name }}
                </label>
            </div>
        @endforeach
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    {!! Form::label('type', 'Type', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        @foreach(\App\Models\PaymentGift::$types as $value=>$name)
            <div class="radio">
                <input type="radio" name="type" id="{{ 'type' . $value }}"
                       value="{{ $value }}" {{ isset($payment_gift) && ( $value == $payment_gift->type) ? 'checked="checked"' : '' }}>
                <label for="{{ 'type' . $value }}">
                    {{ $name }}
                </label>
            </div>
        @endforeach
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('expiration') ? 'has-error' : ''}}">
    {!! Form::label('expiration', 'Expiration', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('expiration', null, ('' == 'required') ? ['class' => 'form-control datetimepicker', 'required' => 'required'] : ['class' => 'form-control datetimepicker']) !!}
        {!! $errors->first('expiration', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

@section('script')

    <script type="text/javascript">
        $().ready(function () {
            // Init DatetimePicker
            app.initFormExtendedDatetimepickers();
        });
    </script>

@endsection