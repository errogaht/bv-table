<?php
/**
 * @var int $contact_id
 */
?>

{!! Form::open(['route' => ['contact_log.store', $contact_id], 'class'=>"form-horizontal"]) !!}
<div class='form-group margin-bottom-none'>
    <div class='col-sm-9'>
        <textarea class="form-control" rows="2" name="comment"></textarea>
    </div>
    <div class='col-sm-3'>
        <button type="submit" class='btn btn-primary pull-right btn-block btn-sm'>Добавить</button>
    </div>
</div>
{!! Form::close() !!}