@extends('layouts.app')

@section('stylesheet')
    <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
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
        $('#table_id').DataTable({
            ordering: true,
            order: [],
            columnDefs: [
                {'targets': [0, 1, 3, 5, 6], 'orderable': false}
            ],
            processing: true,
            serverSide: true,
            ajax: '/crud-akad-list'
        });
    });
</script>
@endsection
