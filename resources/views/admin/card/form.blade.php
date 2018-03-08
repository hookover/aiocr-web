<div class="form-group {{ $errors->has('id') ? 'has-error' : ''}}">
    {!! Form::label('id', 'Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('developer_id') ? 'has-error' : ''}}">
    {!! Form::label('developer_id', 'Developer Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('developer_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('developer_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('user_id', 'User Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('user_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('point_before') ? 'has-error' : ''}}">
    {!! Form::label('point_before', 'Point Before', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('point_before', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('point_before', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('point_after') ? 'has-error' : ''}}">
    {!! Form::label('point_after', 'Point After', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('point_after', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('point_after', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('card') ? 'has-error' : ''}}">
    {!! Form::label('card', 'Card', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('card', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('card', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('point') ? 'has-error' : ''}}">
    {!! Form::label('point', 'Point', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('point', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('point', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('money') ? 'has-error' : ''}}">
    {!! Form::label('money', 'Money', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('money', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('money', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('ip_used') ? 'has-error' : ''}}">
    {!! Form::label('ip_used', 'Ip Used', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('ip_used', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('ip_used', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('ip_created') ? 'has-error' : ''}}">
    {!! Form::label('ip_created', 'Ip Created', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('ip_created', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('ip_created', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('status', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('time_used') ? 'has-error' : ''}}">
    {!! Form::label('time_used', 'Time Used', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('time_used', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('time_used', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('created_at') ? 'has-error' : ''}}">
    {!! Form::label('created_at', 'Created At', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('created_at', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('created_at', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
