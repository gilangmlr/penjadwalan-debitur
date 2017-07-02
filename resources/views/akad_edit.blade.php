@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Ubah Akad</div>

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
                                <div class="input-group clockpicker">
                                    <input id="jam-akad-mulai" type="text" class="form-control" name="jam-akad-mulai" value="{{ old('jam-akad-mulai') }}" required readonly style="background-color: white; cursor: pointer;">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>

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
                                <div class="input-group clockpicker">
                                    <input id="jam-akad-selesai" type="text" class="form-control" name="jam-akad-selesai" value="{{ old('jam-akad-selesai') }}" required readonly style="background-color: white; cursor: pointer;">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>

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
                                    Ubah
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
    function prependedZeroTime(date) {
        var H = date.getHours();
        var HH = H;
        if (H < 10) HH = "0" + H;
        var m = date.getMinutes();
        var mm = m;
        if (m < 10) mm = "0" + m;

        return HH + ":" + mm;
    }

    var date = new Date();
    var formattedTime = prependedZeroTime(date);
    
    $("#jam-akad-mulai").val(formattedTime).attr("placeholder", formattedTime);
    $("#jam-akad-mulai").parent().clockpicker({
        placement: 'top',
        align: 'left',
        donetext: 'Done',
        default: formattedTime
    });

    date.setHours(date.getHours() + 1);
    formattedTime = prependedZeroTime(date);
    $("#jam-akad-selesai").val(formattedTime).attr("placeholder", formattedTime);
    $("#jam-akad-selesai").parent().clockpicker({
        placement: 'top',
        align: 'left',
        donetext: 'Done',
        default: formattedTime
    });
</script>
@endsection
