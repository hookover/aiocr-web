<div class="form-group {{ $errors->has('file_type_id') ? 'has-error' : ''}}">
    {!! Form::label('file_type_id', 'File Type Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('file_type_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('file_type_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('cost') ? 'has-error' : ''}}">
    {!! Form::label('cost', 'Cost', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('cost', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('cost', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('length') ? 'has-error' : ''}}">
    {!! Form::label('length', 'Length', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('length', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('length', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Description', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('description', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('ai_enable') ? 'has-error' : ''}}">
    {!! Form::label('ai_enable', 'Ai Enable', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">

        @foreach(\App\Models\FileType::$ai_status as $value=>$name)
            <div class="radio">
                <input type="radio" name="ai_enable" id="{{ 'ai_enable' . $value }}"
                       value="{{ $value }}" {{ isset($file_type) && ( $value == $file_type->ai_enable) ? 'checked="checked"' : '' }}>
                <label for="{{ 'ai_enable' . $value }}">
                    {{ $name }}
                </label>
            </div>
        @endforeach

        {!! $errors->first('ai_enable', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">

        @foreach(\App\Models\FileType::$status as $value=>$name)
            <div class="radio">
                <input type="radio" name="status" id="{{ 'status' . $value }}"
                       value="{{ $value }}" {{ isset($file_type) && ( $value == $file_type->status) ? 'checked="checked"' : '' }}>
                <label for="{{ 'status' . $value }}">
                    {{ $name }}
                </label>
            </div>
        @endforeach


        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
