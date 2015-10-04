<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Редактирование контакта</h4>
</div>
<div class="modal-body">
    {!! Form::model($contact, array('route' => array('contact.update', $contact->id), 'method' => 'PUT', 'class'=>"form-horizontal")) !!}
    <div class="box-body">
        <div class="col-sm-6">

            @include('input.date', ['title' => 'Дата контакта', 'name' => 'date', 'id' => 'date', 'mask' => "'alias': 'dd.mm.yyyy'", 'val' => ""])
            @include('input.text', ['title' => 'Имя', 'name' => 'name'])
            @include('input.text', ['title' => 'Телефон', 'name' => 'phone'])
            @include('input.text', ['title' => 'Email', 'name' => 'email'])
            @include('input.text', ['title' => 'Город', 'name' => 'city'])
            @include('input.text', ['title' => 'Станция метро', 'name' => 'metro'])
            @include('input.text', ['title' => 'Возраст', 'name' => 'age'])
            @include('input.textarea', ['title' => 'О себе', 'name' => 'about', 'rows' => 3])
            @include('input.textarea', ['title' => 'Как давно знакомы с СК', 'name' => 'how_long', 'rows' => 3])
        </div>
        <div class="col-sm-6">
            @include('input.textarea', ['title' => 'В какое время Вам удобнее посещать встречи?', 'name' => 'preferred_date', 'rows' => 3])

            {{-- Пока кто взял в виде текста - потом сделаем в виде модели User--}}
            {{--@include('input.text', ['title' => 'Кто взял', 'name' => 'user_id', 'id' => 'user_id', 'disabled' => true])--}}
            {!! Form::hidden('user_id', 1) !!}
            @include('input.text', ['title' => 'Кто взял', 'name' => 'user_text'])

            @include('input.select', ['title' => 'Статус', 'name' => 'status', 'options' => ['Новый'=>'Новый', 'Обработка'=>'Обработка', 'Посещает'=>'Посещает', 'Отказ'=>'Отказ']])
            @include('input.select', ['title' => 'Регион', 'name' => 'region_text', 'options' => ['Москва и МО'=>'Москва и МО', 'Россия'=>'Россия', 'Зарубежье'=>'Зарубежье']])
            @include('input.text', ['title' => 'Источник контакта', 'name' => 'from'])

            {{-- пока дата контакта в виде текста, потом сделаем в формателе даты--}}
            @include('input.text', ['title' => 'Дата звонка', 'name' => 'call_date_text'])
            {{--@include('input.date', ['title' => 'Дата звонка', 'name' => 'call_date', 'id' => 'call_date', 'mask' => "'alias': 'dd.mm.yyyy'", 'value' => ""])--}}

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
<div class="modal-footer">
    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
</div>
