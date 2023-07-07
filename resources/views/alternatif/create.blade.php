@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ URL('alternatif') }}" method="POST">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{ show_error($errors) }}
					{{ csrf_field() }}
					<div class="form-group">
						<label>No RM <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="kode_alternatif" value="{{ old('kode_alternatif', kode_oto('kode_alternatif', 'tb_alternatif', 'A', 2)) }}" />
					</div>
					<div class="form-group">
						<label>NIK <span class="text-danger">*</span></label>
						<input class="form-control" type="number" name="nik" value="{{ old('nik') }}" />
					</div>
					<div class="form-group">
						<label>Nama <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama_alternatif" value="{{ old('nama_alternatif') }}" />
					</div>
					<div class="form-group">
						<label>Tempat Lahir <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" />
					</div>
					<div class="form-group">
						<label>Telepon <span class="text-danger">*</span></label>
						<input class="form-control" type="number" name="telepon" value="{{ old('telepon') }}" />
					</div>
					{{-- <div class="form-group">
						<label>Keterangan</label>
						<input class="form-control" type="text" name="keterangan" value="{{ old('keterangan') }}" />
					</div> --}}
					<div class="form-group">
						<label>Alamat</label>
						<input class="form-control" type="text" name="alamat" value="{{ old('alamat') }}" />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Tgl Daftar <span class="text-danger">*</span></label>
						<input class="form-control" type="date" name="tgl_daftar" value="{{ old('tgl_daftar') }}" />
					</div>
					<div class="form-group">
						<label>Tgl Lahir <span class="text-danger">*</span></label>
						<input class="form-control" type="date" name="tgl_lahir" value="{{ old('tgl_lahir') }}" />
					</div>
					<div class="form-group">
						<label>Unit Asal <span class="text-danger">*</span></label>
						{{-- <select class="form-control" name="unitasal">
								<option value="">- Selected -</option>
							@foreach($unitasal as $unit)
								<option value="{{$unit->kode_crips}}">{{$unit->nama_crips}}</option>
							@endforeach
						</select> --}}
						<select class="form-control" name="unit_asal">
							<option value="">- Selected -</option>
							<option value="igd">IGD</option>
							<option value="rawatjalan">Rawat Jalan</option>
							<option value="rawatinap">Rawat Inap</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<a class="btn btn-danger" href="{{ route('alternatif.index') }}"><i class="fa fa-backward"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection