@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('kriteria.update', $row) }}" method="post">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{show_error($errors)}}
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<div class="form-group">
						<label>Kode kriteria <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="kode_kriteria" value="{{ old('kode_kriteria', $row->kode_kriteria) }}" readonly>
					</div>
					<div class="form-group">
						<label>Nama kriteria <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama_kriteria" value="{{ old('nama_kriteria', $row->nama_kriteria) }}">
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<a class="btn btn-danger" href="{{URL('kriteria')}}"><i class="fa fa-backward"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection