{{--<div class="form-group {{ $errors->has('id') ? 'has-error' : ''}}">--}}
    {{--{!! Form::label('id', 'Id', ['class' => 'col-md-4 control-label']) !!}--}}
    {{--<div class="col-md-6">--}}
        {{--{!! Form::number('id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}--}}
        {{--{!! $errors->first('id', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
<div class="form-group {{ $errors->has('developer_id') ? 'has-error' : ''}}">
    {!! Form::label('developer_id', 'Developer Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('developer_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('developer_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', 'Email', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('email', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
    {!! Form::label('username', 'Username', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('username', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    {!! Form::label('phone', 'Phone', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('phone', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('real_name') ? 'has-error' : ''}}">
    {!! Form::label('real_name', 'Real Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('real_name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('real_name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('qq') ? 'has-error' : ''}}">
    {!! Form::label('qq', 'Qq', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('qq', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('qq', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('alipay') ? 'has-error' : ''}}">
    {!! Form::label('alipay', 'Alipay', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('alipay', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('alipay', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('tenpay') ? 'has-error' : ''}}">
    {!! Form::label('tenpay', 'Tenpay', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('tenpay', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('tenpay', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('point_pay_total') ? 'has-error' : ''}}">
    {!! Form::label('point_pay_total', 'Point Pay Total', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('point_pay_total', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('point_pay_total', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('point_pay_current') ? 'has-error' : ''}}">
    {!! Form::label('point_pay_current', 'Point Pay Current', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('point_pay_current', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('point_pay_current', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('point_dividend_total') ? 'has-error' : ''}}">
    {!! Form::label('point_dividend_total', 'Point Dividend Total', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('point_dividend_total', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('point_dividend_total', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('point_dividend_current') ? 'has-error' : ''}}">
    {!! Form::label('point_dividend_current', 'Point Dividend Current', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('point_dividend_current', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('point_dividend_current', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('vip_point') ? 'has-error' : ''}}">
    {!! Form::label('vip_point', 'Vip Point', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('vip_point', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('vip_point', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('status_account') ? 'has-error' : ''}}">
    {!! Form::label('status_account', 'Status Account', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('status_account', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('status_account', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('locked_ip') ? 'has-error' : ''}}">
    {!! Form::label('locked_ip', 'Locked Ip', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('locked_ip', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('locked_ip', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('locked_address_start') ? 'has-error' : ''}}">
    {!! Form::label('locked_address_start', 'Locked Address Start', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('locked_address_start', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('locked_address_start', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('locked_address_end') ? 'has-error' : ''}}">
    {!! Form::label('locked_address_end', 'Locked Address End', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('locked_address_end', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('locked_address_end', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('count_login') ? 'has-error' : ''}}">
    {!! Form::label('count_login', 'Count Login', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('count_login', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('count_login', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('ip_register') ? 'has-error' : ''}}">
    {!! Form::label('ip_register', 'Ip Register', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('ip_register', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('ip_register', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('ip_pre_login') ? 'has-error' : ''}}">
    {!! Form::label('ip_pre_login', 'Ip Pre Login', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('ip_pre_login', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('ip_pre_login', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('ip_last_login') ? 'has-error' : ''}}">
    {!! Form::label('ip_last_login', 'Ip Last Login', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('ip_last_login', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('ip_last_login', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('time_pre_login') ? 'has-error' : ''}}">
    {!! Form::label('time_pre_login', 'Time Pre Login', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('time_pre_login', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('time_pre_login', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('time_last_login') ? 'has-error' : ''}}">
    {!! Form::label('time_last_login', 'Time Last Login', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('time_last_login', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('time_last_login', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
