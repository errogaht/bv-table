<div class="form-group">
    {!! Form::label($name, $title, array('class' => 'col-sm-4 control-label')) !!}
    <div class="col-sm-8">
        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            {!! Form::date($name, null, ['class' => 'form-control']) !!}
        </div><!-- /.input group -->
    </div>
</div>