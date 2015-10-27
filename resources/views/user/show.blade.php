<?php
/**
 * @var \App\User $user
 */
?>

@extends('dashboard')

@section('content')
<div class="row">

    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <a href="http://ru.gravatar.com/"><img class="profile-user-img img-responsive img-circle" src="<?php echo $user->getProfileImage(); ?>" /></a>
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

                <div class="box-body">
                    <div class="form-group">
                        <label for="profile_email">Email</label>
                        <p>{{ $user->email }}</p>
                    </div>
                    <div class="form-group">
                        <label for="profile_phone">Телефон</label>
                        <p>{{ $user->phone }}</p>
                    </div>
                    <div class="form-group">
                        <label for="profile_role">Роль в бхакти-врикше</label>
                        <p>{{ $user->role }}</p>
                    </div>
                    <div class="form-group">
                        <label for="profile_sanga">Санга</label>
                        <p>{{ $user->sanga }}</p>
                    </div>
                    <div class="form-group">
                        <label for="profile_circle">Округ БВ</label>
                        <p>{{ $user->circle }}</p>
                    </div>
                </div> <!-- /.box-body -->

        </div><!-- /.box-->
    </div><!-- /.col -->

</div><!-- /.row -->
@endsection
