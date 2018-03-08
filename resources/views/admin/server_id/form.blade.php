{{--<div class="form-group {{ $errors->has('id') ? 'has-error' : ''}}">--}}
    {{--{!! Form::label('id', 'Id', ['class' => 'col-md-4 control-label']) !!}--}}
    {{--<div class="col-md-6">--}}
        {{--{!! Form::number('id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}--}}
        {{--{!! $errors->first('id', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
<div class="form-group {{ $errors->has('server_id') ? 'has-error' : ''}}">
    {!! Form::label('server_id', 'Server Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('server_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('server_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('server_type') ? 'has-error' : ''}}">
    {!! Form::label('server_type', 'Server Type', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {{--{!! Form::text('server_type', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}--}}
            <select name="server_type">
                @foreach(\App\Models\ServerID::$SERVER_TYPEs as $value=>$name)
            {{--<div class="radio">--}}
                    <option value="{{ $value }}" id="{{ 'server_type' . $value }}" {{ isset($server_id) && ( $value == $server_id->server_type) ? 'selected=selected' : '' }}>{{ $name }}</option>
                {{--<input type="radio" name="server_type" id="{{ 'server_type' . $value }}"--}}
                       {{--value="{{ $value }}" {{ isset($server_id) && ( $value == $server_id->server_type) ? 'checked="checked"' : '' }}>--}}
                {{--<label for="{{ 'server_type' . $value }}">--}}
                    {{--{{ $name }}--}}
                {{--</label>--}}
                @endforeach
            </select>
            {{--</div>--}}
        {!! $errors->first('server_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('server_img_url') ? 'has-error' : ''}}">
    {!! Form::label('server_img_url', 'Server Img Url', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('server_img_url', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('server_img_url', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('server_api_url') ? 'has-error' : ''}}">
    {!! Form::label('server_api_url', 'Server Api Url', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('server_api_url', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('server_api_url', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('server_api_weight') ? 'has-error' : ''}}">
    {!! Form::label('server_api_weight', 'Server Api Weight', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('server_api_weight', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('server_api_weight', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {{--{!! Form::text('status', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}--}}
        @foreach(\App\Models\ServerID::$status as $value=>$name)
            <div class="radio">
                <input type="radio" name="status" id="{{ 'status' . $value }}"
                       value="{{ $value }}" {{ isset($server_id) && ( $value == $server_id->status) ? 'checked="checked"' : '' }}>
                <label for="{{ 'status' . $value }}">
                    {{ $name }}
                </label>
            </div>
        @endforeach
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

{{--<div class="form-group {{ $errors->has('created_at') ? 'has-error' : ''}}">--}}
    {{--{!! Form::label('created_at', 'Created At', ['class' => 'col-md-4 control-label']) !!}--}}
    {{--<div class="col-md-6">--}}
        {{--{!! Form::text('created_at', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}--}}
        {{--{!! $errors->first('created_at', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
