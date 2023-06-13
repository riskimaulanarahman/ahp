@extends('layout.app')
@section('title', $title)
@section('content')
{{ show_msg() }}
<div class="card card-primary card-outline" {{ is_hidden('is_admin') }}>
    <div class="card-header">
        <h3 class="card-title">Kriteria</h3>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <th>Kode</th>
                <th>Nama</th>
                <th>Bobot</th>
            </thead>
            @foreach($kriterias as $key => $val)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $val->nama_kriteria }}</td>
                <td>{{ round($val->bobot, 4) }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

<div class="card card-primary card-outline" {{ is_hidden('is_admin') }}>
    <div class="card-header">
        <h3 class="card-title">Data Alternatif</h3>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <th>Kode</th>
                <th>Nama</th>
                @foreach($kriterias as $key => $val)
                <th>{{ $val->nama_kriteria }}</th>
                @endforeach
            </thead>
            @foreach($rel_alternatif as $key => $val)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $alternatifs[$key]->nama_alternatif }}</td>
                @foreach($val as $k => $v)
                <td>{{ $v }}</td>
                @endforeach
            </tr>
            @endforeach
        </table>
    </div>
</div>

<div class="card card-primary card-outline" {{ is_hidden('is_admin') }}>
    <div class="card-header">
        <h3 class="card-title">Data Nilai</h3>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <th>Kode</th>
                <th>Nama</th>
                @foreach($kriterias as $key => $val)
                <th>{{ $val->nama_kriteria }}</th>
                @endforeach
            </thead>
            @foreach($rel_nilai as $key => $val)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $alternatifs[$key]->nama_alternatif }}</td>
                @foreach($val as $k => $v)
                <td>{{ round($v, 4) }}</td>
                @endforeach
            </tr>
            @endforeach
        </table>
    </div>
</div>

<div class="card card-primary card-outline" {{ is_hidden('is_admin') }}>
    <div class="card-header">
        <h3 class="card-title">Terbobot</h3>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <th>Kode</th>
                <th>Nama</th>
                @foreach($kriterias as $key => $val)
                <th>{{ $val->nama_kriteria }}</th>
                @endforeach
            </thead>
            @foreach($terbobot as $key => $val)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $alternatifs[$key]->nama_alternatif }}</td>
                @foreach($val as $k => $v)
                <td>{{ round($v, 4) }}</td>
                @endforeach
            </tr>
            @endforeach
        </table>
    </div>
</div>

<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Perangkinan</h3>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <th>Rank</th>
                <th {{ is_hidden('is_admin') }}>Kode</th>
                <th>Nama</th>
                <th {{ is_hidden('is_admin') }}>Nilai V</th>
            </thead>
            @foreach($rank as $key => $val)
            <tr>
                <td>{{ $val }}</td>
                <td {{ is_hidden('is_admin') }}>{{ $key }}</td>
                <td>{{ $alternatifs[$key]->nama_alternatif }}</td>
                <td {{ is_hidden('is_admin') }}>{{ round($total[$key], 4) }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="card-footer">
        <a class="btn btn-default" href="{{ route('hitung.cetak') }}" target="_blank"><span class="fa fa-print"></span> Cetak</a>
    </div>
</div>



@endsection