@extends('layouts.app')

@section('stylesheet')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Daftar Akad</div>

                <div class="panel-body">
                    <div id="search-group" class="form-inline">
                      <div class="form-group">
                        <select id="search-category" class="form-control">
                            <option value="7">Pendamping</option>
                            <option value="8">PIC</option>
                            <option value="9">Ruangan</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <input type="text" id="search-box" class="form-control">
                      </div>
                      <button id="search-button" class="btn btn-default">Cari</button>
                    </div>
                    <table id="table_id" class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Debitur</th>
                                <th class="text-center">Fasilitas</th>
                                <th class="text-center">Plafond</th>
                                <th class="text-center">Notaris</th>
                                <th class="text-center">Jam Mulai</th>
                                <th class="text-center">Jam Selesai</th>
                                <th class="text-center">Pendamping</th>
                                <th class="text-center">PIC</th>
                                <th class="text-center">Ruangan</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
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
                {orderable: false, targets: [0, 1, 3, 5, 6, 9]},
                {className: 'text-center', targets: [0, 2, 4, 5, 6, 7, 8, 9]},
                {className: 'text-right', targets: 3}
            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: '/crud-akad-list',
                data: function (d) {
                }
            }
        });

        $('#search').append($('#search-group'));

        $('#search-button').on('click', function() {
            table.column($('#search-category').val()).search($('#search-box').val()).draw();
        });

        $('#search-box').on('keyup', function(e) {
            if(e.keyCode == 13) {
                $('#search-button').click();
            }
        });
    });
</script>
@endsection
