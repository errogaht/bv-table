@extends('auth/template')

@section('content')

    <form method="POST" action="{{ route('auth.login') }}">
        {!! csrf_field() !!}
        <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" name="password" id="password" class="form-control" placeholder="Пароль">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <label>
                    <input type="checkbox" name="remember"> <span style="font-weight: normal;">Запомнить меня</span>
                </label>
            </div>
            <div class="col-xs-6">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Авторизоваться</button>
            </div>
        </div>
    </form>

    <div style="text-align: center; padding-top: 1em;">
        <a href="{{route('auth.register')}}">Регистрация</a>
    </div>

@endsection