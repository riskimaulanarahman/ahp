@extends('layout.app')
@section('title', $title)
@section('content')
{{ show_msg() }}
<div class="card card-primary card-outline">
	<div class="card-header">
		{{-- <form class="form-inline"> --}}
			{{-- <div class="form-group mr-1">
				<input class="form-control" type="text" name="q" value="{{ $q }}" placeholder="Pencarian..." />
			</div> --}}
			{{-- <div class="form-group mr-1">
				<button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
			</div> --}}
			{{-- <div class="form-group mr-1" {{ is_hidden('kriteria.create') }}>
				<a class="btn btn-primary" href="{{ route('kriteria.create') }}"><i class="fa fa-plus"></i> Tambah</a>
			</div> --}}
			{{-- <div class="form-group mr-1" {{ is_hidden('kriteria.cetak') }}>
				<a class="btn btn-default" href="{{ route('kriteria.cetak') }}" target="_blank"><span class="fa fa-print"></span> Cetak</a>
			</div> --}}
		{{-- </form> --}}
	</div>
	<div class="card-body p-0 table-responsive">
		<form action="{{ route('konfigurasi.update', $row) }}" method="post">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							{{show_error($errors)}}
							{{ csrf_field() }}
							{{ method_field('PUT') }}
							<div class="form-group">
								<label>Jumlah Mesin <span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="jml_mesin" value="{{ old('jml_mesin', $row->jml_mesin) }}" >
							</div>
							<div class="form-group">
								<label>Jumlah Shift <span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="jml_shift" value="{{ old('jml_shift', $row->jml_shift) }}">
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
					{{-- <a class="btn btn-danger" href="{{URL('kriteria')}}"><i class="fa fa-backward"></i> Kembali</a> --}}
				</div>
			</div>
		</form>
		{{-- <table class="table table-bordered table-hover">
			<thead>
				<th>Jumlah</th>
				<th>Kode</th>
				<th>Nama kriteria</th>
				<th>Bobot</th>
				<th>Aksi</th>
			</thead>
			@foreach($rows as $key => $row)
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
			@endforeach
		</table> --}}
	</div>
	{{-- @if ($rows->hasPages())
	<div class="card-footer">
		{{ $rows->links() }}
	</div>
	@endif --}}
</div>
@endsection