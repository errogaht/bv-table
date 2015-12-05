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
                        <th></th>
                        <th></th>
                        <th>Имя</th>
                        <th>Телефон</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $user)
                        <tr>
                            <td>
                                @if ($user->is_admin)
                                    <small class="label bg-blue" title="Админ">A</small>
                                @endif
                            </td>
                            <td>
                                @if ($user->is_active)
                                    <small class="label bg-green" title="Доступ разрешен">ok</small>
                                @else
                                    <small class="label bg-red" title="Доступ закрыт">&mdash;</small>
                                @endif
                            </td>
                            <td><a href="{!! route('user.show', [$user]) !!}">{{ $user->name }}</a></td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
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