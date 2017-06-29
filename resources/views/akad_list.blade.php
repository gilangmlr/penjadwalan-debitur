@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Daftar Akad</div>

                <div class="panel-body">
                    <table id="table_id" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Debitur</th>
                                <th>Fasilitas</th>
                                <th>Plafond</th>
                                <th>Notaris</th>
                                <th>Jam Akad</th>
                                <th>Jam Selesai Akad</th>
                                <th>Pendamping</th>
                                <th>PIC</th>
                                <th>Ruangan</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Debitur</th>
                                <th>Fasilitas</th>
                                <th>Plafond</th>
                                <th>Notaris</th>
                                <th>Jam Akad</th>
                                <th>Jam Selesai Akad</th>
                                <th>Pendamping</th>
                                <th>PIC</th>
                                <th>Ruangan</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#table_id').DataTable({
            dom: "<'row'<'col-sm-6'l><'.col-sm-6.form-inline'<'#search.pull-right'>>>" +
"<'row'<'col-sm-12'tr>>" +
"<'row'<'col-sm-5'i><'col-sm-7'p>>",
            ordering: true,
            order: [],
            autoWidth: false,
            columnDefs: [
                {'targets': [0, 1, 3, 5, 6], 'orderable': false}
            ],
            processing: true,
            serverSide: true,
            ajax: '/crud-akad-list'
        });

        $('#search').append('<div class="form-group"><input id="search-pendamping" class="form-control" type="text" placeholder="Cari Pendamping" /></div>');
        $('#search').append('<div class="form-group"><input id="search-pic" class="form-control" type="text" placeholder="Cari PIC" /></div>');
        $('#search').append('<div class="form-group"><input id="search-ruangan" class="form-control" type="text" placeholder="Cari Ruangan" /></div>');

        $('#search-pendamping').on('keyup', function() {
            table.column(7).search(this.value).draw();
        });
        $('#search-pic').on('keyup', function() {
            table.column(8).search(this.value).draw();
        });
        $('#search-ruangan').on('keyup', function() {
            table.column(9).search(this.value).draw();
        });
    });
</script>
@endsection
