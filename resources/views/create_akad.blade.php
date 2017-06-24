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
                                <select id="nama-notaris" type="text" class="form-control" name="nama-notaris" value="{{ old('nama-notaris') }}">
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
                                <select id="fasilitas" type="text" class="form-control" name="fasilitas" value="{{ old('fasilitas') }}">
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
                            <label for="plafond" class="col-md-4 control-label">Plafond (Rp.)</label>

                            <div class="col-md-6">
                                <input id="plafond" type="text" class="form-control" name="plafond" value="{{ old('plafond') }}" required autofocus>

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
                                <select id="pendamping" type="text" class="form-control" name="pendamping" value="{{ old('pendamping') }}">
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
                                <select id="pic" type="text" class="form-control" name="pic" value="{{ old('pic') }}">
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

                        <div class="form-group{{ $errors->has('ruangan') ? ' has-error' : '' }}">
                            <label for="ruangan" class="col-md-4 control-label">Ruangan</label>

                            <div class="col-md-6">
                                <select id="ruangan" type="text" class="form-control" name="ruangan" value="{{ old('ruangan') }}">
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
