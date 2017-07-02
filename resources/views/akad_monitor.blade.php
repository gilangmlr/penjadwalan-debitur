@extends('layouts.app')

@section('stylesheet')
    <style type="text/css">
        .csbg-success {
            background-color: #dff0d8 !important; 
            /*background-color: #008000 !important; 
            color: white;*/
        }

        .csbg-danger {
            background-color: #f2dede !important; 
            /*background-color: #800000 !important; 
            color: white;*/
        }

        .csbg-info {
            /*background-color: #d9edf7 !important; */
            background-color: #000080 !important; 
            color: white;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Daftar Akad<div class="pull-right">Jam Komputer: <span id="computer-time"></span></div></div>

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
    function prependedZeroTime(date) {
        var H = date.getHours();
        var HH = H;
        if (H < 10) HH = "0" + H;
        var m = date.getMinutes();
        var mm = m;
        if (m < 10) mm = "0" + m;

        return HH + ":" + mm;
    }

    $(document).ready(function() {
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
                    _: 'jamMulai.time',
                    sort: 'jamMulai.timestamp'
                    },
                    name: 'jamMulai', targets: 5},
                {data: {
                    _: 'jamSelesai.time',
                    sort: 'jamSelesai.timestamp'
                    },
                    name: 'jamSelesai', targets: 6},
                {data: 'pendamping', name: 'pendamping', targets: 7},
                {data: 'pIC', name: 'pIC', targets: 8},
                {data: 'ruangan', name: 'ruangan', targets: 9},

                {orderable: false, targets: [0, 1, 3, 5, 6, 9]},
                {className: 'text-center', targets: [0, 2, 4, 5, 6, 7, 8, 9]},
                {className: 'text-right', targets: 3}
            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: '/crud-akad-list',
                data: function ( d ) {
                    d.current_date = Math.round(new Date().getTime() / 1000);
                }
            },
            drawCallback: function(settings) {
                checkNotif();
                setInterval(checkNotif, 5000);
            }
        });

        function checkNotif() {
            var data = table.rows().data();
            data.each(function (value, index) {
                var startTimeMoment = moment.unix(value.jamMulai.timestamp);
                var endTimeMoment = moment.unix(value.jamSelesai.timestamp);
                var computerTimeMoment = moment($('#computer-time').text(), 'HH:mm');

                if (computerTimeMoment.isSameOrAfter(startTimeMoment) &&
                        computerTimeMoment.isBefore(endTimeMoment)) {
                    // on going
                    $(table.row(index).node()).addClass('csbg-success');
                    // console.log('sedang berlangsung');
                    var startDiff = computerTimeMoment.diff(startTimeMoment, 'minutes');
                    // console.log('startDiff: ');
                    // console.log(startDiff);
                    var endDiff = computerTimeMoment.diff(endTimeMoment, 'minutes');
                    // console.log('endDiff: ');
                    // console.log(endDiff);
                    if (startDiff >= 45) {
                        if (!$(table.row(index).node()).hasClass('csbg-danger')) {
                            $(table.row(index).node()).removeClass('csbg-success');
                            $(table.row(index).node()).addClass('csbg-danger');
                            var msg = value['ruangan'] + ' dengan ' + value['namaDebitur'] + ' akan selesai pada pukul ' + value.jamSelesai.time;
                            $.notify({
                                message: msg
                            },{
                                type: 'danger',
                                delay: (((-1 * endDiff) * 60) - 30) * 1000
                            });
                        }
                    }
                }
                else if (computerTimeMoment.isAfter(endTimeMoment)) {
                    // done

                    $(table.row(index).node()).removeClass('csbg-success');
                    $(table.row(index).node()).removeClass('csbg-danger');

                    $(table.row(index).node()).addClass('csbg-info');

                    // console.log(computerTimeMoment);
                    // console.log(endTimeMoment);
                }
                else {
                    // not yet
                    $(table.row(index).node()).removeClass('csbg-success');
                    $(table.row(index).node()).removeClass('csbg-danger');
                    $(table.row(index).node()).removeClass('csbg-info');
                }
            });
        }

        $('#search').append($('#search-group'));

        $('#search-button').on('click', function() {
            table.column($('#search-category').val()).search($('#search-box').val()).draw();
        });

        $('#search-box').on('keyup', function(e) {
            if(e.keyCode == 13) {
                $('#search-button').click();
            }
        });

        var d = new Date();
        var time = prependedZeroTime(d);
        document.getElementById('computer-time').innerHTML = time;
    
        setInterval(function(){
            var d = new Date();
            var time = prependedZeroTime(d);
            document.getElementById('computer-time').innerHTML = time;
        }, 1000);
    });
</script>
@endsection
