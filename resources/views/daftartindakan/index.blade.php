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
			<div class="form-group mr-1" {{ is_hidden('daftartindakan.create') }}>
				<a class="btn btn-primary" href="{{ route('daftartindakan.create') }}"><i class="fa fa-plus"></i> Tambah Tindakan</a>
			</div>
			{{-- <div class="form-group mr-1" {{ is_hidden('rel_alternatif.cetak') }}>
				<a class="btn btn-default" href="{{ route('rel_alternatif.cetak') }}" target="_blank"><span class="fa fa-print"></span> Cetak</a>
			</div> --}}
		</form>
	</div>
	<div class="card-body p-0 table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<th>No</th>
				<th>NRM</th>
				<th>Nama</th>
				<th>Tgl Tindakan</th>
				<th>Jam Tindakan</th>
				<th>Shift</th>
				{{--<th>Nilai LFG</th>
				<th>Penyakit Penyulit</th>
				<th>Level Kesadaran</th>
				<th>Asal Unit</th>
				<th>Jenis Tindakan</th> --}}
				{{-- @foreach($kriterias as $kriteria)
				<th>{{ $kriteria->nama_kriteria }}</th>
				@endforeach --}}
				<th>Jenis Tindakan</th>
				<th>Status Tindakan</th>
				<th>Aksi</th>
			</thead>
			@foreach($rows as $key => $row)
			{{-- {{ dd($row) }} --}}
			<tr>
				<td>{{ ($rows->currentPage() - 1) * $limit + $key + 1}}</td>
				<td>{{ $row->kode_alternatif }}</td>
				<td><a href="{{ route('alternatif.detail', ['kode_alternatif'=> $row->kode_alternatif ]) }}">{{ $row->nama_alternatif }}</a></td>
				<td>{{ $row->tgl_tindakan }}</td>
				<td>{{ $row->jam_tindakan }}</td>
				<td>{{ $row->shift }}</td>
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
					@if($row->status_tindakan == 1)
						<button type="" class="btn btn-xs btn-primary"> Dialisis</button>
					@elseif($row->status_tindakan == 2)
						<button type="" class="btn btn-xs btn-primary"> Tidak hadir</button>
					@elseif($row->status_tindakan == 3)
						<button type="" class="btn btn-xs btn-primary"> Dirujuk alasan klinis</button>
					@elseif($row->status_tindakan == 4)
						<button type="" class="btn btn-xs btn-primary"> Dirujuk alasan sarpras</button>
					@elseif($row->status_tindakan == 5)
						<button type="" class="btn btn-xs btn-primary"> Tidak layak HD</button>
					@elseif($row->status_tindakan == 6)
						<button type="" class="btn btn-xs btn-primary"> Jadwal ulang alasan klinis</button>
					@elseif($row->status_tindakan == 7)
						<button type="" class="btn btn-xs btn-primary"> Jadwal ulang alasan sarpras</button>
					@endif
				</td>
				<td>
					<a class="btn btn-xs btn-primary" href="{{ route('daftartindakan.edit', $row->id) }}" {{ is_hidden('daftartindakan.edit') }}><i class="fa fa-edit"></i>Edit</a>
					<form action="{{ route('daftartindakan.destroy', $row->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Hapus Data?')" {{ is_hidden('daftartindakan.destroy') }}>
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</button>
					</form>
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