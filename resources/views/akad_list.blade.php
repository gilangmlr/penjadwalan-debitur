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
                                <th class="text-center"></th>
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
<script src="{{ asset('js/bootstrap3-dialog.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        function timestampToDateTime(data, type, full, meta) {
            moment.locale('id');
            return moment.unix(data).format('LLL');
        }

        var lihatDefaultContent = '<button class="btn btn-default btn-sm center-block"><span class="glyphicon glyphicon-search"></span> Lihat</button>';
        var table = $('#table_id').DataTable({
            dom: "<'row'<'col-sm-6'l><'.col-sm-6.form-inline'<'#search.pull-right'>>>" +
                 "<'row'<'col-sm-12'tr>>" +
                 "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            ordering: true,
            order: [],
            autoWidth: false,
            columnDefs: [
                {data: 'no', name: 'no', targets: 0},
                {data: 'namaDebitur', name: 'namaDebitur', targets: 1},
                {data: 'fasilitas', name: 'fasilitas', targets: 2},
                {data: 'plafond', name: 'plafond', targets: 3},
                {data: 'notaris', name: 'notaris', targets: 4},
                {data: {
                    _: 'jamMulai.timestamp',
                    sort: 'jamMulai.timestamp'
                    },
                    name: 'jamMulai', targets: 5,
                    render: timestampToDateTime},
                {data: {
                    _: 'jamSelesai.timestamp',
                    sort: 'jamSelesai.timestamp'
                    },
                    name: 'jamSelesai', targets: 6,
                    render: timestampToDateTime},
                {data: 'pendamping', name: 'pendamping', targets: 7},
                {data: 'pIC', name: 'pIC', targets: 8},
                {data: 'ruangan', name: 'ruangan', targets: 9},
                {data: null , name: 'action', targets: 10,
                    defaultContent: lihatDefaultContent},

                {visible: false, targets: [2, 3, 9]},
                {orderable: false, targets: [0, 1, 3, 5, 6, 9, 10]},
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
