@extends('dashboard')

@section('content')
    <div class="row">

        <div class="col-xs-12">

            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="contacts_table" class="table table-bordered table-striped">
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
                            <th>Комментарий</th>
                            <th>Статус</th>
                            <th>Откуда</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contacts as $contact)
                            <tr>
                                <td>{{ date_create($contact->created_at)->format('d.m.Y H:i') }}</td>
                                <td><a href="{{ route('contact.edit', ['id'=>$contact->id]) }}">{{ $contact->name }}</a></td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->city }}</td>
                                <td>{{ $contact->metro }}</td>
                                <td>{{ $contact->age }}</td>
                                <td>{{ $contact->how_long }}</td>
                                <td>{{ $contact->preferred_date }}</td>
                                <td>{{ $contact->comment }}</td>
                                <td>{{ $contact->status }}</td>
                                <td>{{ $contact->source }}</td>
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
                            <th>Комментарий</th>
                            <th>Статус</th>
                            <th>Откуда</th>
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



@section('js')
<!-- DataTables -->
<script src="{{ asset ("/bower_components/admin-lte/plugins/datatables/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset ("/bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.min.js") }}"></script>
<script src="{{ asset ("/bower_components/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
<script src="{{ asset ("/bower_components/admin-lte/plugins/fastclick/fastclick.min.js") }}"></script>
<script>
    $(function () {
        $('#contacts_table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true
        });
    });
</script>
@endsection
