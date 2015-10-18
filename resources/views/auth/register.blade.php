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