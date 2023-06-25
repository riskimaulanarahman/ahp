@extends('layout.app')
@section('title', $title)
@section('content')
<style>
    .merah {
        background-color: lightcoral;
    }
</style>
{{ show_msg() }}

<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Periode Perubahan</h3>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-bordered" style="font-size:12px;">
            {{-- <thead>
                <th>Prioritas</th>
                <th {{ is_hidden('is_admin') }}>NRM/Nama</th>
                <th>Frekuensi</th>
                <th>Jenis Tindakan</th>
                <th {{ is_hidden('is_admin') }}>Nilai V</th>
            </thead> --}}
            {{-- {{dd($alternatifs)}} --}}
            <thead>
                <tr>
                    <th rowspan="2" style="text-align:center; vertical-align: top;">Prioritas</th>
                    <th rowspan="2" style="text-align:center; vertical-align: top;">NRM/Nama</th>
                    <th rowspan="2" style="text-align:center; vertical-align: top;">Frekuensi</th>
                    <th rowspan="2" style="text-align:center; vertical-align: top;">Jenis Tindakan</th>
                    <th colspan="2" style="text-align:center; vertical-align: top;">Senin</th>
                    <th colspan="2" style="text-align:center; vertical-align: top;">Selasa</th>
                    <th colspan="2" style="text-align:center; vertical-align: top;">Rabu</th>
                    <th colspan="2" style="text-align:center; vertical-align: top;">Kamis</th>
                    <th colspan="2" style="text-align:center; vertical-align: top;">Jumat</th>
                    <th colspan="2" style="text-align:center; vertical-align: top;">Sabtu</th>
                    <th rowspan="2" style="text-align:center; vertical-align: top;">Nilai LFG</th>
                    <th rowspan="2" style="text-align:center; vertical-align: top;">Penyakit Penyulit</th>
                    <th rowspan="2" style="text-align:center; vertical-align: top;">Level Kesadaran</th>
                    <th rowspan="2" style="text-align:center; vertical-align: top;">Asal Unit</th>
                    <th rowspan="2" style="text-align:center; vertical-align: top;">Keadaan Umum</th>
                    {{-- <th rowspan="2" style="text-align:center; vertical-align: top;">Nilai V</th> --}}
                </tr>
                <tr>
                    <th>Shift 1</th>
                    <th>Shift 2</th>
                    <th>Shift 1</th>
                    <th>Shift 2</th>
                    <th>Shift 1</th>
                    <th>Shift 2</th>
                    <th>Shift 1</th>
                    <th>Shift 2</th>
                    <th>Shift 1</th>
                    <th>Shift 2</th>
                    <th>Shift 1</th>
                    <th>Shift 2</th>
                </tr>
			</thead>
            {{-- {{dd($key)}} --}}
            {{-- &#9989; --}}
            {{-- &nbsp; --}}
            @foreach($rank as $key => $val)
            <tr class="{{ ($alternatifs[$key]['jenis_tindakan'] == 'inisiasi') ? 'merah' : '' }}">
                <td>{{ $val }}</td>
                <td>{{ $key }}/{{ $alternatifs[$key]['nama_alternatif'] }}</td>
                <td>{{ ($alternatifs[$key]['jenis_tindakan'] == 'inisiasi') ? 3 : 2 }}</td>
                <td>{{ $alternatifs[$key]['jenis_tindakan'] }}</td>
                <td><input type="checkbox" onclick="tambahshift(this)" id="checkbox_{{ $key }}"></td> 
                <td><input type="checkbox" onclick="tambahshift(this)" id="checkbox_{{ $key }}"></td>
                <td><input type="checkbox" onclick="tambahshift(this)" id="checkbox_{{ $key }}"></td>
                <td><input type="checkbox" onclick="tambahshift(this)" id="checkbox_{{ $key }}"></td>
                <td><input type="checkbox" onclick="tambahshift(this)" id="checkbox_{{ $key }}"></td>
                <td><input type="checkbox" onclick="tambahshift(this)" id="checkbox_{{ $key }}"></td>
                <td><input type="checkbox" onclick="tambahshift(this)" id="checkbox_{{ $key }}"></td>
                <td><input type="checkbox" onclick="tambahshift(this)" id="checkbox_{{ $key }}"></td>
                <td><input type="checkbox" onclick="tambahshift(this)" id="checkbox_{{ $key }}"></td>
                <td><input type="checkbox" onclick="tambahshift(this)" id="checkbox_{{ $key }}"></td>
                <td><input type="checkbox" onclick="tambahshift(this)" id="checkbox_{{ $key }}"></td>
                <td><input type="checkbox" onclick="tambahshift(this)" id="checkbox_{{ $key }}"></td>
                <td>{{ $alternatifs[$key]['nama_K01'] }}</td>
                <td>{{ $alternatifs[$key]['nama_K02'] }}</td>
                <td>{{ $alternatifs[$key]['nama_K03'] }}</td>
                <td>{{ $alternatifs[$key]['nama_K05'] }}</td>
                <td>{{ $alternatifs[$key]['nama_K04'] }}</td>
                {{-- <td>{{ round($total[$key], 4) }}</td> --}}
            </tr>
            @endforeach
        </table>
    </div>
    {{-- <div class="card-footer">
        <a class="btn btn-default" href="{{ route('hitung.cetak') }}" target="_blank"><span class="fa fa-print"></span> Cetak</a>
    </div> --}}
</div>



@endsection

<script>
function tambahshift(checkbox) {
    if (checkbox.checked) {
        alert("Berhasil Menambah shift");
    } else {
        alert("Menghapus shift");
    }
}
</script>