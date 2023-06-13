@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ URL('crips') }}" method="POST">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{ show_error($errors) }}
					{{ csrf_field() }}
					<div class="form-group">
						<label>Kode <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="kode_crips" value="{{ old('kode_crips', kode_oto('kode_crips', 'tb_crips', 'S', 2)) }}" />
					</div>
					<div class="form-group">
						<label>Kriteria <span class="text-danger">*</span></label>
						<select class="form-control" name="kode_kriteria">
							<?= get_kriteria_option(old('kode_kriteria')) ?>
						</select>
					</div>
					<div class="form-group">
						<label>Nama crips <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama_crips" value="{{ old('nama_crips') }}" />
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<a class="btn btn-danger" href="{{ route('crips.index') }}"><i class="fa fa-backward"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection