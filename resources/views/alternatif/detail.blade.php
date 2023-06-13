@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('alternatif.detail.update') }}" method="post">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    {{show_error($errors)}}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Kode alternatif <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="kode_alternatif" value="{{ old('kode_alternatif', $row->kode_alternatif) }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama alternatif <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="nama_alternatif" value="{{ old('nama_alternatif', $row->nama_alternatif) }}" readonly>
                    </div>
                    @foreach($nilais as $nilai)
                    <div class="form-group">
                        <label> {{ $nilai->nama_kriteria }} </label>
                        <select class="form-control" name="nilai[{{ $nilai->ID }}]">
                            <?= get_crips_option($nilai->kode_kriteria, $nilai->kode_crips) ?>
                        </select>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
            <a class="btn btn-danger" href="{{URL('alternatif')}}"><i class="fa fa-backward"></i> Kembali</a>
            <a class="btn btn-info" href="{{ route('hitung.index')}}"><i class="fa fa-signal"></i> Proses Perhitungan</a>
        </div>
    </div>
</form>
@endsection