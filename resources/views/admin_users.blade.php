@extends('layouts.app')

@section('stylesheet')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Daftar Pengguna</div>

                <div class="panel-body">
                    <table id="table_id" class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">Nama</th>
                                <th class="text-center">NIK</th>
                                <th class="text-center">Email</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-center">{{$user['name']}}</td>
                                    <td class="text-center">{{$user['nik']}}</td>
                                    <td class="text-center">{{$user['email']}}</td>
                                    <td class="text-center">
                                        <button onclick="showDetails(this)" class="btn btn-default btn-sm center-block">
                                            <span class="glyphicon glyphicon-search"></span> Lihat
                                        </button>
                                    </td>
                                    <td>{
                                    "admin": "{{$user['permissions']['admin'] ? 'true' : 'false'}}",
                                    @foreach($permissions as $perm)
                                        "{{$perm}}": "{{$user['permissions'][$perm] ? 'true' : 'false'}}"
                                        @if($perm != end($permissions))
                                            ,
                                        @endif
                                    @endforeach
                                    }</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    var table;
    function showDetails(that) {
        var data = table.row(that.parentNode).data();
        $('#details-tpl .pull-left').parent().css('padding-left', '0');
        $('#nama-details').html(data.nama);
        $('#nik-details').html(data.nik);
        $('input[name=nik]').val(data.nik);
        $('#email-details').html(data.email);

        var permissions = JSON.parse(data.permissions);

        var formTpl =   '<form>' +
                            '<div class="row">' +
                                '<div class="col-xs-4"><div class="pull-right"><strong>Nama: </strong></div></div>' +

                                '<div class="col-xs-6" style="padding-left: 0">' +
                                    '<div id="nama-details" class="pull-left">' +
                                        data.nama +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                            '<div class="row">' +
                                '<div class="col-xs-4"><div class="pull-right"><strong>NIK: </strong></div></div>' +

                                '<div class="col-xs-6" style="padding-left: 0">' +
                                    '<div id="nik-details" class="pull-left">' +
                                        data.nik +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                            '<div class="row">' +
                                '<div class="col-xs-4"><div class="pull-right"><strong>Email: </strong></div></div>' +

                                '<div class="col-xs-6" style="padding-left: 0">' +
                                    '<div id="email-details" class="pull-left">' +
                                        data.email +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                            '<div class="row">' +
                                '<div class="col-xs-4"><div class="pull-right"><strong>Admin: </strong></div></div>' +

                                '<div class="col-xs-6" style="padding-left: 0">' +
                                    '<div id="" class="pull-left">' +
                                        '<input type="checkbox" name="admin" ' +
                                            (permissions['admin'] == 'true' ? 'checked ' : '') + 
                                            @if(!Auth::user()->hasRole('admin'))
                                                'disabled' +
                                            @endif
                                            '>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                            '<hr />' +
                            '<input type="hidden" name="nik" value="' + data.nik + '">' +
                            '<div class="row">' +
                                '<div class="col-xs-6">' +
                                @foreach($permissionsOne as $perm)
                                    '<div class="row">' +
                                        '<div class="col-xs-8"><div class="pull-right"><strong>{{ucfirst($perm[0])}} {{ucfirst($perm[1])}}: </strong></div></div>' +

                                        '<div class="col-xs-4" style="padding-left: 0">' +
                                            '<div id="" class="pull-left">' +
                                                '<input type="checkbox" name="{{$perm[0]}}-{{$perm[1]}}" ' +
                                                    (permissions['{{$perm[0]}}-{{$perm[1]}}'] == 'true' ? 'checked ' : '') + 
                                                    @if(!Auth::user()->ability('admin,ubah-pengguna-role', 'ubah-pengguna'))
                                                        'disabled' +
                                                    @endif
                                                    '>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                @endforeach
                                '</div>' +
                                '<div class="col-xs-6">' +
                                @foreach($permissionsTwo as $perm)
                                    '<div class="row">' +
                                        '<div class="col-xs-8"><div class="pull-right"><strong>{{ucfirst($perm[0])}} {{ucfirst($perm[1])}}: </strong></div></div>' +

                                        '<div class="col-xs-4" style="padding-left: 0">' +
                                            '<div id="" class="pull-left">' +
                                                '<input type="checkbox" name="{{$perm[0]}}-{{$perm[1]}}" ' +
                                                    (permissions['{{$perm[0]}}-{{$perm[1]}}'] == 'true' ? 'checked ' : '') + 
                                                    @if(!Auth::user()->ability('admin,ubah-pengguna-role', 'ubah-pengguna'))
                                                        'disabled' +
                                                    @endif
                                                    '>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                @endforeach
                                '</div>' +
                            '</div>' +
                        '</form>';

        function callbackFn() {
            console.log($('input[name=lihat-akad]').is(':checked'));
            $.ajax({
                url: '/crud-admin-users-edit',
                method: 'POST',
                data: $('form').serialize()
            });
            // window.location.href = '/view-admin-users';
        }

        @if(Auth::user()->ability('admin,hapus-akad-role', 'hapus-akad'))
            var buttons = {
                            'save': {
                                label: 'Simpan',
                                callback: callbackFn
                            },
                            'close': {
                                label: 'Tutup',
                                callback:  function(){
                                    $('#details-tpl').addClass('hidden');
                                }
                            }
                        }
        @else
            var buttons = {
                            'close': {
                                label: 'Tutup',
                                callback:  function(){
                                    $('#details-tpl').addClass('hidden');
                                }
                            }
                        }
        @endif
        
        bootbox.dialog({
            title: 'Izin Pengguna',
            message: formTpl,
            backdrop: true,
            onEscape: true,
            buttons: buttons
        });
    }
    $(document).ready(function() {
        table = $('#table_id').DataTable({
            processing: true,
            columnDefs: [
                {data: 'nama', name: 'nama', targets: 0},
                {data: 'nik', name: 'nik', targets: 1},
                {data: 'email', name: 'email', targets: 2},
                {name: 'details', orderable: false, targets: 3},
                {data: 'permissions', name: 'permissions', orderable: false, visible: false, targets: 4}
            ]
        });
    });
</script>
@endsection
