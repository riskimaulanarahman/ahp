@extends('layout.app')
@section('title', $title)
@section('content')
{{ show_msg() }}
<div class="card card-primary card-outline">
	<div class="card-body p-0 table-responsive">
		
		<table class="table table-bordered table-hover" style="font-size:12px;">
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
                </tr>
                <tr>
                    {{-- style="white-space: nowrap;" --}}
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
            <tbody>
                <tr>
                    <td>1</td>
                    <td>0040/Aryani Rusli</td>
                    <td>3</td>
                    <td>inisiasi</td>
                    <td>&#9989;</td>
                    <td>&nbsp;</td>
                    <td>&#9989;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><=10ml/mnt</td>
                    <td>sindroma uremikum</td>
                    <td>GCS 14-15</td>
                    <td>IGD</td>
                    <td>berat</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>0039/Bagus Santoso</td>
                    <td>3</td>
                    <td>inisiasi</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><=5ml/mnt</td>
                    <td>overload cairan di tubuh</td>
                    <td>GCS 12-13</td>
                    <td>IGD</td>
                    <td>sedang</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>0040/Selamat</td>
                    <td>3</td>
                    <td>reguler</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><=10ml/mnt</td>
                    <td>encephalopati uremikum</td>
                    <td>GCS 10-11</td>
                    <td>IGD</td>
                    <td>Sedang</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>0040/Rusdin</td>
                    <td>3</td>
                    <td>reguler</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><=15ml/mnt</td>
                    <td>pericarditis uremikum</td>
                    <td>GCS 7-9</td>
                    <td>Rawat Jalan</td>
                    <td>Sedang</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>0040/Eko Sutarjo</td>
                    <td>3</td>
                    <td>reguler</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><=15ml/mnt</td>
                    <td>tidak ada penyulit</td>
                    <td>GCS 4-6</td>
                    <td>Rawat Jalan</td>
                    <td>Sedang</td>
                </tr>
            </tbody>
			{{-- @foreach($rows as $key => $row)
			<tr>
				<td>{{ ($rows->currentPage() - 1) * $limit + $key + 1}}</td>
				<td>{{ $row->kode_kriteria }}</td>
				<td>{{ $row->nama_kriteria }}</td>
				<td>{{ round($row->bobot, 4) }}</td>
				<td>
					<a class="btn btn-xs btn-info" href="{{ route('kriteria.edit', $row) }}" {{ is_hidden('kriteria.edit') }}><i class="fa fa-edit"></i> Ubah</a>
					<form action="{{ route('kriteria.destroy', $row) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Hapus Data?')" {{ is_hidden('kriteria.destroy') }}>
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</button>
					</form>
				</td>
			</tr>
			@endforeach --}}
		</table>
	</div>
</div>
@endsection