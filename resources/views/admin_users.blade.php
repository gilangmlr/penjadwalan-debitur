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
                                    <td>{"buat_akad": "{{$user['permissions']['buat_akad'] ? 'true' : 'false'}}",
                                    "ubah_akad": "{{$user['permissions']['ubah_akad'] ? 'true' : 'false'}}",
                                    "hapus_akad": "{{$user['permissions']['hapus_akad'] ? 'true' : 'false'}}"}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="form-group hidden" id="details-tpl">
                        <div class="row">
                            <div class="col-xs-4"><div class="pull-right"><strong>Nama: </strong></div></div>

                            <div class="col-xs-6">
                                <div id="nama-details" class="pull-left">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4"><div class="pull-right"><strong>NIK: </strong></div></div>

                            <div class="col-xs-6">
                                <div id="nik-details" class="pull-left">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4"><div class="pull-right"><strong>Email: </strong></div></div>

                            <div class="col-xs-6">
                                <div id="email-details" class="pull-left">
                                </div>
                            </div>
                        </div>
                        <hr />
                        <form>
                            <div class="row">
                                <div class="col-xs-4"><div class="pull-right"><strong>Buat Akad: </strong></div></div>

                                <div class="col-xs-6">
                                    <div id="" class="pull-left">
                                        <input type="checkbox" name="buat-akad">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4"><div class="pull-right"><strong>Ubah Akad: </strong></div></div>

                                <div class="col-xs-6">
                                    <div id="" class="pull-left">
                                        <input id="ubah-akad" type="checkbox" name="ubah-akad">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4"><div class="pull-right"><strong>Hapus Akad: </strong></div></div>

                                <div class="col-xs-6">
                                    <div id="" class="pull-left">
                                        <input type="checkbox" name="hapus-akad">
                                    </div>
                                </div>
                            </div>
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/bootbox.min.js') }}"></script>
<script type="text/javascript">
    var table;
    function showDetails(that) {
        var data = table.row(that.parentNode).data();
        $('#details-tpl').removeClass('hidden');
        $('#details-tpl .pull-left').parent().css('padding-left', '0');
        $('#nama-details').html(data.nama);
        $('#nik-details').html(data.nik);
        $('#email-details').html(data.email);
        
        var permissions = JSON.parse(data.permissions);

        $('input[name=buat-akad]').attr('checked', permissions['buat_akad'] == 'true' ? true : false);
        $('#ubah-akad').attr('checked', permissions['ubah_akad'] == 'true' ? true : false);
        $('input[name=hapus-akad]').attr('checked', permissions['hapus_akad'] == 'true' ? true : false);

        @if(Auth::user()->ability('admin,hapus-akad-role', 'hapus-akad'))
            var buttons = {
                            'save': {
                                label: 'Simpan',
                                callback: function() {
                                    $.ajax({
                                        url: '/crud-admin-users-edit',
                                        method: 'POST',
                                        data: $('form').serialize()
                                    });
                                    // window.location.href = '/view-admin-users-list';
                                }
                            },
                            'close': {
                                label: 'Tutup',
                                callback:  function(){}
                            }
                        }
        @else
            var buttons = {
                            'close': {
                                label: 'Tutup',
                                callback:  function(){}
                            }
                        }
        @endif
        
        bootbox.dialog({
            title: 'Izin Pengguna',
            message: $('#details-tpl').html(),
            backdrop: true,
            onEscape: true,
            buttons: buttons
        });
        $('#details-tpl').addClass('hidden');
    }
    $(document).ready(function() {
        table = $('#table_id').DataTable({
            columnDefs: [
                {data: 'nama', name: 'nama', targets: 0},
                {data: 'nik', name: 'nik', targets: 1},
                {data: 'email', name: 'email', targets: 2},
                {name: 'details', visible: detailsVisibility, orderable: false, targets: 3},
                {data: 'permissions', name: 'permissions', orderable: false, visible: false, targets: 4}
            ]
        });
    });
</script>
@endsection
