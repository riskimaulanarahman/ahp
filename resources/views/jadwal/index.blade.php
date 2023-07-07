@extends('layout.app')
@section('title', $title)
@section('content')
<style>
    .merah {
        background-color: lightcoral;
    }
</style>
{{ show_msg() }}

{{-- @isset($total)
    Belum ada Jadwal yang diajukan
@else --}}
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
                    <th rowspan="2" style="text-align:center; vertical-align: top;">Tindak Lanjut</th>
                    <th colspan="3" class="days" style="text-align:center; vertical-align: top;">Senin</th>
                    <th colspan="3" class="days" style="text-align:center; vertical-align: top;">Selasa</th>
                    <th colspan="3" class="days" style="text-align:center; vertical-align: top;">Rabu</th>
                    <th colspan="3" class="days" style="text-align:center; vertical-align: top;">Kamis</th>
                    <th colspan="3" class="days" style="text-align:center; vertical-align: top;">Jumat</th>
                    <th colspan="3" class="days" style="text-align:center; vertical-align: top;">Sabtu</th>
                    <th rowspan="2" style="text-align:center; vertical-align: top;">Nilai LFG</th>
                    <th rowspan="2" style="text-align:center; vertical-align: top;">Penyakit Penyulit</th>
                    <th rowspan="2" style="text-align:center; vertical-align: top;">Level Kesadaran</th>
                    <th rowspan="2" style="text-align:center; vertical-align: top;">Asal Unit</th>
                    <th rowspan="2" style="text-align:center; vertical-align: top;">Keadaan Umum</th>
                    <th rowspan="2" style="text-align:center; vertical-align: top;">Nilai V</th>
                </tr>
                <tr>
                    <th>Shift 1</th>
                    <th>Shift 2</th>
                    <th>Shift 3</th>
                    <th>Shift 1</th>
                    <th>Shift 2</th>
                    <th>Shift 3</th>
                    <th>Shift 1</th>
                    <th>Shift 2</th>
                    <th>Shift 3</th>
                    <th>Shift 1</th>
                    <th>Shift 2</th>
                    <th>Shift 3</th>
                    <th>Shift 1</th>
                    <th>Shift 2</th>
                    <th>Shift 3</th>
                    <th>Shift 1</th>
                    <th>Shift 2</th>
                    <th>Shift 3</th>
                </tr>
			</thead>
            {{-- {{dd($alternatifs["A01"])}} --}}
            {{-- &#9989; --}}
            {{-- &nbsp; --}}
            @foreach($rank as $key => $val)
            <tr class="{{ ($alternatifs[$key]['jenis_tindakan'] == 'inisiasi' && $alternatifs[$key]['totalshift'] == 0 ) ? 'merah' : '' }}">
                <td>{{ $val }}</td>
                <td>{{ $key }}/{{ $alternatifs[$key]['nama_alternatif'] }}</td>
                <td>{{ ($alternatifs[$key]['jenis_tindakan'] == 'inisiasi') ? 3 : 2 }}</td>
                <td>{{ $alternatifs[$key]['jenis_tindakan'] }}</td>
                <td>
                    <select name="status jadwal" id="">
                        <option value="2">Dijadwalkan</option>
                        <option value="3">Dirujuk alasan klinis</option>
                        <option value="4">Dirujuk alasan sarpras</option>
                        <option value="5">Tidak layak HD</option>
                    </select>
                </td>
                <td><input type="checkbox" onclick="tambahshift(this,'{{$key}}',this.getAttribute('data-shift'),this.getAttribute('data-hari'))" data-shift="1" data-hari="senin" {{($alternatifs[$key]["senin"][0]["shift_1"] == 1) ? "checked" : ''}}></td> 
                <td><input type="checkbox" onclick="tambahshift(this,'{{$key}}',this.getAttribute('data-shift'),this.getAttribute('data-hari'))" data-shift="2" data-hari="senin" {{($alternatifs[$key]["senin"][1]["shift_2"] == 1) ? "checked" : ''}}></td> 
                <td><input type="checkbox" onclick="tambahshift(this,'{{$key}}',this.getAttribute('data-shift'),this.getAttribute('data-hari'))" data-shift="3" data-hari="senin" {{($alternatifs[$key]["senin"][2]["shift_3"] == 1) ? "checked" : ''}}></td> 
                <td><input type="checkbox" onclick="tambahshift(this,'{{$key}}',this.getAttribute('data-shift'),this.getAttribute('data-hari'))" data-shift="1" data-hari="selasa" {{($alternatifs[$key]["selasa"][0]["shift_1"] == 1) ? "checked" : ''}}></td> 
                <td><input type="checkbox" onclick="tambahshift(this,'{{$key}}',this.getAttribute('data-shift'),this.getAttribute('data-hari'))" data-shift="2" data-hari="selasa" {{($alternatifs[$key]["selasa"][1]["shift_2"] == 1) ? "checked" : ''}}></td> 
                <td><input type="checkbox" onclick="tambahshift(this,'{{$key}}',this.getAttribute('data-shift'),this.getAttribute('data-hari'))" data-shift="3" data-hari="selasa" {{($alternatifs[$key]["selasa"][2]["shift_3"] == 1) ? "checked" : ''}}></td> 
                <td><input type="checkbox" onclick="tambahshift(this,'{{$key}}',this.getAttribute('data-shift'),this.getAttribute('data-hari'))" data-shift="1" data-hari="rabu" {{($alternatifs[$key]["rabu"][0]["shift_1"] == 1) ? "checked" : ''}}></td> 
                <td><input type="checkbox" onclick="tambahshift(this,'{{$key}}',this.getAttribute('data-shift'),this.getAttribute('data-hari'))" data-shift="2" data-hari="rabu" {{($alternatifs[$key]["rabu"][1]["shift_2"] == 1) ? "checked" : ''}}></td> 
                <td><input type="checkbox" onclick="tambahshift(this,'{{$key}}',this.getAttribute('data-shift'),this.getAttribute('data-hari'))" data-shift="3" data-hari="rabu" {{($alternatifs[$key]["rabu"][2]["shift_3"] == 1) ? "checked" : ''}}></td> 
                <td><input type="checkbox" onclick="tambahshift(this,'{{$key}}',this.getAttribute('data-shift'),this.getAttribute('data-hari'))" data-shift="1" data-hari="kamis" {{($alternatifs[$key]["kamis"][0]["shift_1"] == 1) ? "checked" : ''}}></td> 
                <td><input type="checkbox" onclick="tambahshift(this,'{{$key}}',this.getAttribute('data-shift'),this.getAttribute('data-hari'))" data-shift="2" data-hari="kamis" {{($alternatifs[$key]["kamis"][1]["shift_2"] == 1) ? "checked" : ''}}></td> 
                <td><input type="checkbox" onclick="tambahshift(this,'{{$key}}',this.getAttribute('data-shift'),this.getAttribute('data-hari'))" data-shift="3" data-hari="kamis" {{($alternatifs[$key]["kamis"][2]["shift_3"] == 1) ? "checked" : ''}}></td> 
                <td><input type="checkbox" onclick="tambahshift(this,'{{$key}}',this.getAttribute('data-shift'),this.getAttribute('data-hari'))" data-shift="1" data-hari="jumat" {{($alternatifs[$key]["jumat"][0]["shift_1"] == 1) ? "checked" : ''}}></td> 
                <td><input type="checkbox" onclick="tambahshift(this,'{{$key}}',this.getAttribute('data-shift'),this.getAttribute('data-hari'))" data-shift="2" data-hari="jumat" {{($alternatifs[$key]["jumat"][1]["shift_2"] == 1) ? "checked" : ''}}></td> 
                <td><input type="checkbox" onclick="tambahshift(this,'{{$key}}',this.getAttribute('data-shift'),this.getAttribute('data-hari'))" data-shift="3" data-hari="jumat" {{($alternatifs[$key]["jumat"][2]["shift_3"] == 1) ? "checked" : ''}}></td> 
                <td><input type="checkbox" onclick="tambahshift(this,'{{$key}}',this.getAttribute('data-shift'),this.getAttribute('data-hari'))" data-shift="1" data-hari="sabtu" {{($alternatifs[$key]["sabtu"][0]["shift_1"] == 1) ? "checked" : ''}}></td> 
                <td><input type="checkbox" onclick="tambahshift(this,'{{$key}}',this.getAttribute('data-shift'),this.getAttribute('data-hari'))" data-shift="2" data-hari="sabtu" {{($alternatifs[$key]["sabtu"][1]["shift_2"] == 1) ? "checked" : ''}}></td> 
                <td><input type="checkbox" onclick="tambahshift(this,'{{$key}}',this.getAttribute('data-shift'),this.getAttribute('data-hari'))" data-shift="3" data-hari="sabtu" {{($alternatifs[$key]["sabtu"][2]["shift_3"] == 1) ? "checked" : ''}}></td> 
                
                <td>{{ $alternatifs[$key]['nama_K01'] }}</td>
                <td>{{ $alternatifs[$key]['nama_K02'] }}</td>
                <td>{{ $alternatifs[$key]['nama_K03'] }}</td>
                <td>{{ $alternatifs[$key]['unit_asal'] }}</td>
                <td>{{ $alternatifs[$key]['nama_K04'] }}</td>
                <td>{{ round($total[$key], 4) }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    {{-- <div class="card-footer">
        <a class="btn btn-default" href="{{ route('hitung.cetak') }}" target="_blank"><span class="fa fa-print"></span> Cetak</a>
    </div> --}}
</div>
{{-- @endif --}}
<input type="hidden" name="_token" value="{{ csrf_token() }}">


@endsection

<script>
function tambahshift(check,key,shift,hari) {
    if (check.checked) {
        console.log('check')
        console.log(key)
        console.log(shift)
        console.log(hari)
        $.ajax({
            url: '/updatejadwal',
            type: 'POST',
            data: {
                kode:key,
                hari:hari,
                shift:shift,
                value:1,
                _token: $('input[name="_token"]').val(),
            },
            success: function(data) {
                alert('Data berhasil disimpan.');
                location.reload();
            },
            error: function(error) {
                alert('Error.');
            },
        });
    } else {
        console.log('uncheck')
        console.log(key)
        console.log(shift)
        console.log(hari)
        $.ajax({
            url: '/updatejadwal',
            type: 'POST',
            data: {
                kode:key,
                hari:hari,
                shift:shift,
                value:0,
                _token: $('input[name="_token"]').val(),
            },
            success: function(data) {
                alert('Data berhasil disimpan.');
                location.reload();
            },
            error: function(error) {
                alert('Error.');
            },
        });
    }
}
</script>