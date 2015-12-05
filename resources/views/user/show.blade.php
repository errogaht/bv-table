<?php
/**
 * @var \App\User $user
 */
?>

@extends('dashboard')

@section('content')
<div class="row">

    <div class="col-md-3">
        @include('user/_user_info')
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

                    @if ($me->is_admin)
                        {!! Form::open(['route'=>['user.active', $user->id], 'method'=>'put']) !!}
                        @if ($user->is_active)
                            <button class="btn btn-danger pull-right btn-sm">Заблокировать</button>
                            <input type="hidden" name="action" value="0" />
                        @else
                            <button class="btn btn-success pull-right btn-sm">Активировать</button>
                            <input type="hidden" name="action" value="1" />
                        @endif
                        {!! Form::close() !!}
                    @endif
                </div> <!-- /.box-body -->

        </div><!-- /.box-->
    </div><!-- /.col -->

</div><!-- /.row -->
@endsection
