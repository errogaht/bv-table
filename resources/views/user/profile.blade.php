<?php
/**
 * @var \App\User $user
 */

$roles = [
    'Слуга-лидер БВ1',
    'помощник Слуги-лидера БВ1',
    'Слуга-лидер сектора',
    'Слуга-лидер округа',
];
if (($role_new = (old('role') ?: $user->role)) && !in_array($role_new, $roles)) {
    array_unshift($roles, $role_new);
}
$roles = array_combine($roles, $roles);
?>

@extends('dashboard')

@section('content')
<div class="row">

    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="http://www.gravatar.com/avatar/{{md5($user->email)}}?s=100&amp;d=wavatar" alt="User profile picture">
                <h3 class="profile-username text-center">{{$user->name}}</h3>
                <p class="text-muted text-center">{{$user->role}}</p>
                <p class="text-muted text-center">Санга: {{$user->sanga}}</p>
                <p class="text-muted text-center">Округ: {{$user->circle}}</p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>В обработке</b> <a class="pull-right">0</a>
                    </li>
                    <li class="list-group-item">
                        <b>Посещает</b> <a class="pull-right">0</a>
                    </li>
                </ul>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->

    <div class="col-md-9">
        <div class="box box-primary">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::open(['url'=>'profile', 'method'=>'put', 'style'=>'width: 50%;']) !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="profile_name">Имя</label>
                        <input type="text" name="name" value="{{ old('name') ?: $user->name}}" class="form-control" id="profile_name" placeholder="Ваше имя" required="true">
                    </div>
                    <div class="form-group">
                        <label for="profile_email">Email</label>
                        <input type="email" name="email" value="{{ old('email') ?: $user->email}}" class="form-control" id="profile_email" placeholder="Ваш email" required="true">
                    </div>
                    <div class="form-group">
                        <label for="profile_phone">Телефон</label>
                        <input type="tel" name="phone" value="{{ old('phone') ?: '+'.$user->phone}}" class="form-control" id="profile_phone" placeholder="+79161234567" required="true">
                    </div>
                    <div class="form-group">
                        <label for="profile_role">Моя роль в бхакти-врикше</label>
                        <?php echo Form::select('role',$roles,(old('role') ?: $user->role),['id'=>'profile_role','class'=>'form-control select2']); ?>
                    </div>
                    <div class="form-group">
                        <label for="profile_sanga">Моя санга: БВ, ее слуга-лидер</label>
                        <input type="text" name="sanga" value="{{ old('sanga') ?: $user->sanga }}" class="form-control" id="profile_sanga" placeholder="например: БВ2 Кузьминки, Нандагопал дас" required="true">
                    </div>
                    <div class="form-group">
                        <label for="profile_circle">Округ БВ</label>
                        <input type="text" name="circle" value="{{ old('circle') ?: $user->circle }}" class="form-control" id="profile_circle" placeholder="" required="true">
                    </div>
                </div> <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            {!! Form::close() !!}
        </div><!-- /.box-->
    </div><!-- /.col -->

</div><!-- /.row -->
@endsection


@section('head')
    <link rel="stylesheet" href="/bower_components/admin-lte/plugins/select2/select2.min.css">
@endsection

@section('js')
    <script src="/bower_components/admin-lte/plugins/select2/select2.full.min.js"></script>
    <script>
        $(function () {
            $("#profile_role").select2({
                tags: true,
                createTag: function (params) {
                    return {
                        id: params.term,
                        text: params.term,
                        newOption: true
                    }
                }
            });
        });
    </script>
@endsection