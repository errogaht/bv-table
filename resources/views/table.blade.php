@extends('dashboard')

@section('content')
    <div class="row">

        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Добавить новый контакт</h3>
                </div>

                <!-- Modal -->
                <div id="editContact" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Modal Header</h4>
                            </div>
                            <div class="modal-body">
                                <p>Some text in the modal.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(array('action' => 'ContactController@store', 'class'=>"form-horizontal")) !!}

                {!! Form::token() !!}
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
                        {!! Form::hidden('user_id', 1) !!}
                        {{--@include('input.text', ['title' => 'Кто взял', 'name' => 'user_id', 'id' => 'user_id', 'disabled' => true])--}}
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
                    <button type="submit" class="btn btn-info pull-right">Добавить</button>
                </div>
                <!-- /.box-footer -->
                {!! Form::close() !!}
            </div>
            <!-- /.box -->
        </div>
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Table With Full Features</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Дата</th>
                            <th>Имя</th>
                            <th>Телефон</th>
                            <th>Email</th>
                            <th>Город</th>
                            <th>Станция метро</th>
                            <th>Возраст</th>
                            <th>Как давно знакомы с СК?</th>
                            <th>В какое время удобно?</th>
                            <th>О себе</th>
                            <th>Кто взял</th>
                            <th>Статус</th>
                            <th>Комментарий</th>
                            <th>Откуда</th>
                            <th>Кто звонил / когда</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contacts as $contact)
                            <tr>
                                <td>{{ $contact->date }}</td>
                                <td><a href="{!! action('ProfileController@show', ['id' => $contact->id]) !!}">{{ $contact->name }}</a></td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->city }}</td>
                                <td>{{ $contact->metro }}</td>
                                <td>{{ $contact->age }}</td>
                                <td>{{ $contact->how_long }}</td>
                                <td>{{ $contact->preferred_date }}</td>
                                <td>{{ $contact->about }}</td>
                                <td>{{ $contact->user_text }}</td>
                                <td>{{ $contact->status }}</td>
                                <td>{{ $contact->comment }}</td>
                                <td>{{ $contact->from }}</td>
                                <td>{{ $contact->call_date_text }}</td>
                                <td><a href="#" data-url="{!! action('ContactController@edit', ['id' => $contact->id]) !!}" class="edit-link">E</a></td>

                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Дата</th>
                            <th>Имя</th>
                            <th>Телефон</th>
                            <th>Email</th>
                            <th>Город</th>
                            <th>Станция метро</th>
                            <th>Возраст</th>
                            <th>Как давно знакомы с СК?</th>
                            <th>В какое время удобно?</th>
                            <th>О себе</th>
                            <th>Кто взял</th>
                            <th>Статус</th>
                            <th>Комментарий</th>
                            <th>Откуда</th>
                            <th>Кто звонил / когда</th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div><!-- /.row -->
@endsection