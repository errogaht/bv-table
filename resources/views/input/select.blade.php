<div class="form-group">
    {!! Form::label($name, $title, array('class' => 'col-sm-4 control-label')) !!}
    <div class="col-sm-8">
        {!! Form::select($name, $options, null, ['class' => 'form-control']) !!}
    </div>
</div>
