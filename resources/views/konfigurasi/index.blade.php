@extends('layout.app')
@section('title', $title)
@section('content')
{{ show_msg() }}
<div class="card card-primary card-outline">
	<div class="card-header">
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
								<input class="form-control" type="number" name="jml_mesin" value="{{ old('jml_mesin', $row->jml_mesin) }}" >
							</div>
							<div class="form-group">
								<label>Jumlah Mesin <span class="text-danger">*</span></label>
								<input class="form-control" type="number" name="jml_mesinopr" value="{{ old('jml_mesinopr', $row->jml_mesinopr) }}" >
							</div>
							<div class="form-group">
								<label>Jumlah Shift <span class="text-danger">*</span></label>
								<input class="form-control" type="number" min="1" max="3" name="jml_shift" value="{{ old('jml_shift', $row->jml_shift) }}">
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
				</div>
			</div>
		</form>
	</div>
	
</div>
@endsection