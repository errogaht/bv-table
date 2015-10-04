<div class="form-group">
    {!! Form::label($name, $title, array('class' => 'col-sm-4 control-label')) !!}
    <div class="col-sm-8">
        {!! Form::textarea($name, null, ['cols' => 35, 'rows' => 5, 'class' => "form-control"]) !!}
    </div>
</div>