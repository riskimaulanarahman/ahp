@extends('layout.app')
@section('title', $title)
@section('content')
{{ show_msg() }}
<div class="card card-primary card-outline">
	<div class="card-header">
		<form class="form-inline">
			<div class="form-group mr-1">
				<input class="form-control" type="text" name="q" value="{{ $q }}" placeholder="Pencarian..." />
			</div>
			<div class="form-group mr-1">
				<button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
			</div>
			{{-- <div class="form-group mr-1">
				<a class="btn btn-primary" href="#"><i class="fa fa-plus"></i> Pengajuan Baru</a>
			</div> --}}
			<div class="form-group mr-1" {{ is_hidden('rel_alternatif.cetak') }}>
				<a class="btn btn-default" href="{{ route('rel_alternatif.cetak') }}" target="_blank"><span class="fa fa-print"></span> Cetak</a>
			</div>
		</form>
	</div>
	<div class="card-body p-0 table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<th>No</th>
				<th>NRM</th>
				<th>Nama</th>
				<th>Tgl Pengajuan</th>
				<th>Jam Pengajuan</th>
				{{--<th>Nilai LFG</th>
				<th>Penyakit Penyulit</th>
				<th>Level Kesadaran</th>
				<th>Asal Unit</th>
				<th>Jenis Tindakan</th> --}}
				{{-- @foreach($kriterias as $kriteria)
				<th>{{ $kriteria->nama_kriteria }}</th>
				@endforeach --}}
				<th>Jenis Tindakan</th>
				<th>Aksi</th>
			</thead>
			@foreach($rows as $key => $row)
			{{-- {{ dd($row) }} --}}
			<tr>
				<td>{{ ($rows->currentPage() - 1) * $limit + $key + 1}}</td>
				<td>{{ $row->kode_alternatif }}</td>
				<td>{{ $row->nama_alternatif }}</td>
				<td>{{ $row->tgl_pengajuan }}</td>
				<td>{{ $row->jam_pengajuan }}</td>
				{{-- <td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td> --}}
				{{-- @foreach($rel_alternatif[$row->kode_alternatif] as $k => $v)
				<td>{{ isset($crips[$v]) ? $crips[$v]->nama_crips : '' }}</td>
				@endforeach --}}
				<td>{{ $row->jenis_tindakan }}</td>
				<td>
					<button type="" class="btn btn-xs btn-danger" onclick="batalkan('{{$row->kode_alternatif}}')"> Berhenti HD</button>
					@if($row->status == 0)
						<a class="btn btn-xs btn-primary" href="{{ route('rel_alternatif.edit', $row) }}" {{ is_hidden('rel_alternatif.edit') }}><i class="fa fa-edit"></i> Pengajuan Jadwal</a>
					@endif	
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if ($rows->hasPages())
	<div class="card-footer">
		{{ $rows->links() }}
	</div>
	@endif
</div>
@endsection

<script>
	function batalkan(kode) {

		var confirmed = confirm("Apakah Anda Yakin ?");

		if (confirmed) {
			var xhr = new XMLHttpRequest();

			xhr.open('GET', '/api/updatestatus/'+kode+'?status=0', true);

			xhr.onreadystatechange = function() {
				if (xhr.readyState === 4 && xhr.status === 200) {
					var response = xhr.responseText;
					window.location.href = "/rel_alternatif";
				}
			};

			xhr.send(); 
		}
	}

</script>