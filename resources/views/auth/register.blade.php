<?php
$roles = [
        'Слуга-лидер БВ1',
        'помощник Слуги-лидера БВ1',
        'Слуга-лидер сектора',
        'Слуга-лидер округа',
];
if (($role_new = old('role')) && !in_array($role_new, $roles)) {
    array_unshift($roles, $role_new);
}
$roles = array_combine($roles, $roles);
?>

@extends('auth/template')

@section('content')

    <form method="POST" action="{{ route('auth.register') }}">
        {!! csrf_field() !!}
        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Ваше имя" required >
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="tel" class="form-control" name="phone" placeholder="+79161234567" value="{{ old('phone') }}" required>
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <label for="profile_role">Моя роль в бхакти-врикше</label>
            <?php echo Form::select('role',$roles,old('role'),['id'=>'profile_role','class'=>'form-control select2']); ?>
        </div>
        <div class="form-group has-feedback">
            <label for="profile_sanga">Моя санга: БВ, ее слуга-лидер</label>
            <input type="text" name="sanga" value="{{ old('sanga') }}" class="form-control" id="profile_sanga" placeholder="например: БВ2 Кузьминки, Нандагопал дас" required="true">
        </div>
        <div class="form-group has-feedback">
            <label for="profile_circle">Округ БВ</label>
            <input type="text" name="circle" value="{{ old('circle') }}" class="form-control" id="profile_circle" placeholder="" required="true">
        </div>

        <div class="form-group has-feedback">
            <input type="password" name="password" id="password" class="form-control" placeholder="Пароль" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Подтвердите пароль" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <div class="row">
            <div class="col-xs-8" style="margin: 0 auto; float: none;">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Зарегистрироваться</button>
            </div>
        </div>
    </form>

    <div style="text-align: center; padding-top: 1em;">
        <a href="{{route('auth.login')}}">Авторизация</a>
    </div>

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