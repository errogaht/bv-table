@extends('dashboard')

@section('content')
    <div class="row">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Зарегистрированные пользователи</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Регистрация</th>
                        <th>Имя</th>
                        <th>Телефон</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $user)
                        <tr>
                            <td>{{ date_create($user->created_at)->format('d.m.Y') }}</td>
                            <td><a href="{!! action('UserController@show', ['id' => $user->id]) !!}">{{ $user->name }}</a></td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <?php echo $list->render(); ?>
            </div>
        </div>
        <!-- /.box -->
    </div><!-- /.row -->
@endsection