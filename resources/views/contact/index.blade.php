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
                            <th>Статус</th>
                            <th>Имя</th>
                            <th>Город</th>
                            <th>Метро</th>
                            <th>Откуда</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contacts as $contact)
                            <tr>
                                <td style="white-space: nowrap;">{{ date_create($contact->created_at)->format('Y-m-d') }}</td>
                                <td><span class="label label-success">{{ $contact->getStatus(true) }}</span></td>
                                <td style="white-space: nowrap;"><a href="{{ route('contact.show', ['id'=>$contact->id]) }}">{{ $contact->name }}</a></td>
                                <td>{{ $contact->city }}</td>
                                <td>{{ $contact->metro }}</td>
                                <td>{{ $contact->source }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Дата</th>
                            <th>Имя</th>
                            <th>Город</th>
                            <th>Метро</th>
                            <th>Статус</th>
                            <th>Откуда</th>
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
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true
        });
    });
</script>
@endsection
