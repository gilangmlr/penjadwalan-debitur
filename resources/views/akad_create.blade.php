@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Input Akad Baru</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('crud-akad-create') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nama-notaris') ? ' has-error' : '' }}">
                            <label for="nama-notaris" class="col-md-4 control-label">Nama Notaris</label>

                            <div class="col-md-6">
                                <select id="nama-notaris" type="text" class="form-control" name="id-notaris" value="{{ old('nama-notaris') }}">
                                    @foreach($notaris as $nota)
                                        <option value="{{ $nota->id }}">{{$nota->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('nama-notaris'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama-notaris') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nama-debitur') ? ' has-error' : '' }}">
                            <label for="nama-debitur" class="col-md-4 control-label">Nama Debitur</label>

                            <div class="col-md-6">
                                <input id="nama-debitur" type="text" class="form-control" name="nama-debitur" value="{{ old('nama-debitur') }}" required autofocus>

                                @if ($errors->has('nama-debitur'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama-debitur') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('fasilitas') ? ' has-error' : '' }}">
                            <label for="fasilitas" class="col-md-4 control-label">Fasilitas</label>

                            <div class="col-md-6">
                                <select id="fasilitas" type="text" class="form-control" name="id-fasilitas" value="{{ old('fasilitas') }}">
                                    @foreach($fasilitas as $fasil)
                                        <option value="{{ $fasil->id }}">{{$fasil->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('fasilitas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fasilitas') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('plafond') ? ' has-error' : '' }}">
                            <label for="plafond" class="col-md-4 control-label">Plafond</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">Rp.</span>
                                    <input id="plafond" type="text" class="form-control" name="plafond" value="{{ old('plafond') }}" required autofocus>
                                </div>

                                @if ($errors->has('plafond'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('plafond') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('pendamping') ? ' has-error' : '' }}">
                            <label for="pendamping" class="col-md-4 control-label">Pendamping</label>

                            <div class="col-md-6">
                                <select id="pendamping" type="text" class="form-control" name="id-pendamping" value="{{ old('pendamping') }}">
                                    @foreach($pendamping as $pendam)
                                        <option value="{{ $pendam->id }}">{{$pendam->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('pendamping'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pendamping') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('pic') ? ' has-error' : '' }}">
                            <label for="pic" class="col-md-4 control-label">PIC</label>

                            <div class="col-md-6">
                                <select id="pic" type="text" class="form-control" name="id-pic" value="{{ old('pic') }}">
                                    @foreach($pic as $pi)
                                        <option value="{{ $pi->id }}">{{$pi->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('pic'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pic') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('jam-akad-mulai') ? ' has-error' : '' }}">
                            <label for="jam-akad-mulai" class="col-md-4 control-label">Jam Mulai</label>
                            <div class="col-md-6">
                                <div class="input-group date">
                                    <input id="jam-akad-mulai" name="jam-akad-mulai" class="form-control" size="16" type="text" readonly style="background-color: white; cursor: pointer;">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </span>
                                </div>

                                <div class="warning"></div>
                                @if ($errors->has('jam-akad-mulai'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jam-akad-mulai') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('jam-akad-selesai') ? ' has-error' : '' }}">
                            <label for="jam-akad-selesai" class="col-md-4 control-label">Jam Selesai</label>
                            <div class="col-md-6">
                                <div class="input-group date">
                                    <input id="jam-akad-selesai" name="jam-akad-selesai" class="form-control" size="16" type="text" readonly style="background-color: white; cursor: pointer;">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </span>
                                </div>

                                <div class="warning"></div>
                                @if ($errors->has('jam-akad-selesai'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jam-akad-selesai') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ruangan') ? ' has-error' : '' }}">
                            <label for="ruangan" class="col-md-4 control-label">Ruangan</label>

                            <div class="col-md-6">
                                <select id="ruangan" type="text" class="form-control" name="id-ruangan" value="{{ old('ruangan') }}">
                                    @foreach($ruangan as $ruang)
                                        <option value="{{ $ruang->id }}">{{$ruang->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('ruangan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ruangan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Buat
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    var momentObj = moment();
    var formattedTime = momentObj.format('YYYY-MM-DD HH:mm:ss');
    
    $("#jam-akad-mulai").val(formattedTime).attr("placeholder", formattedTime);
    $("#jam-akad-mulai").parent().datetimepicker({
        format: 'yyyy-mm-dd hh:ii:ss',
        initialDate: new Date(),
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        pickerPosition: "top-left"
    });

    formattedTime = momentObj.add(1, 'h').format('YYYY-MM-DD HH:mm:ss');

    $("#jam-akad-selesai").val(formattedTime).attr("placeholder", formattedTime);
    $("#jam-akad-selesai").parent().datetimepicker({
        format: 'yyyy-mm-dd hh:ii:ss',
        initialDate: new Date(),
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        pickerPosition: "top-left"
    });

    $('form').on('submit', function(e){
        e.preventDefault();
        var jamMulaiMoment = moment($('#jam-akad-mulai').val(), 'YYYY-MM-DD HH:mm:ss');
        var jamSelesaiMoment = moment($('#jam-akad-selesai').val(), 'YYYY-MM-DD HH:mm:ss');
        var timeDiff =jamSelesaiMoment.diff(jamMulaiMoment, 'minutes');
        $('#jam-akad-selesai').parent().parent().find('.warning').html('');
        if (0 <= timeDiff && timeDiff <= 60) {
            this.submit();
        }
        else if (timeDiff < 0) {
            $('#jam-akad-selesai').parent().parent().find('.warning').html($('<span class="help-block text-danger"><strong>Durasi negatif! Otomatis menjadi satu jam.</strong></span>'));
            $('#jam-akad-selesai').val(jamMulaiMoment.add(1, 'h').format('YYYY-MM-DD HH:mm:ss'));
            $("#jam-akad-selesai").parent().datetimepicker('update');
        }
        else {
            $('#jam-akad-selesai').parent().parent().find('.warning').html($('<span class="help-block text-danger"><strong>Maksimum satu jam! Otomatis menjadi satu jam.</strong></span>'));
            $('#jam-akad-selesai').val(jamMulaiMoment.add(1, 'h').format('YYYY-MM-DD HH:mm:ss'));
            $("#jam-akad-selesai").parent().datetimepicker('update');
        }
    });
</script>
@endsection
