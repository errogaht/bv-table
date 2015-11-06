@extends('dashboard')

@section('content')
<div class="box">

        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-2">
                    <span class="label label-success" style="font-size: 100%; font-weight: normal; padding: 6px 12px;">Новый</span>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>

    @if ($contact->id)
        {!! Form::model($contact, array('route' => array('contact.update', $contact->id), 'method' => 'PUT', 'class'=>"form-horizontal")) !!}
    @else
        {!! Form::model($contact, array('route' => array('contact.store'), 'method' => 'POST', 'class'=>"form-horizontal")) !!}
    @endif
    <div class="box-body">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="col-sm-6">
            @include('input.text', ['title' => 'Имя', 'name' => 'name'])
            @include('input.text', ['title' => 'Телефон', 'name' => 'phone'])
            @include('input.text', ['title' => 'Email', 'name' => 'email'])
            @include('input.text', ['title' => 'Город', 'name' => 'city'])
            @include('input.text', ['title' => 'Станция метро', 'name' => 'metro'])
            @include('input.text', ['title' => 'Возраст', 'name' => 'age'])
        </div>
        <div class="col-sm-6">
            @include('input.text', ['title' => 'Как давно знакомы с СК', 'name' => 'how_long', 'rows' => 3])
            @include('input.text', ['title' => 'В какое время Вам удобнее посещать встречи?', 'name' => 'preferred_date', 'rows' => 3])
            @include('input.text', ['title' => 'Источник контакта', 'name' => 'source'])
            @include('input.textarea', ['title' => 'Комментарий', 'name' => 'comment', 'rows' => 3])
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right">Сохранить</button>
    </div>
    <!-- /.box-footer -->
    {!! Form::close() !!}
</div>
@endsection