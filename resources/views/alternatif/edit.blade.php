@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('alternatif.update', $row) }}" method="post">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{show_error($errors)}}
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<div class="form-group">
						<label>No RM <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="kode_alternatif" value="{{ old('kode_alternatif', $row->kode_alternatif) }}" readonly>
					</div>
					<div class="form-group">
						<label>NIK <span class="text-danger">*</span></label>
						<input class="form-control" type="number" name="nik" value="{{ old('nik', $row->nik) }}">
					</div>
					<div class="form-group">
						<label>Nama <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama_alternatif" value="{{ old('nama_alternatif', $row->nama_alternatif) }}">
					</div>
					<div class="form-group">
						<label>Tempat Lahir <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $row->tempat_lahir) }}" >
					</div>
					<div class="form-group">
						<label>Telepon <span class="text-danger">*</span></label>
						<input class="form-control" type="number" name="telepon" value="{{ old('telepon', $row->telepon) }}" >
					</div>
					{{-- <div class="form-group">
						<label>Keterangan</label>
						<input class="form-control" type="text" name="keterangan" value="{{ old('keterangan', $row->keterangan) }}" />
					</div> --}}
					<div class="form-group">
						<label>Alamat <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="alamat" value="{{ old('alamat', $row->alamat) }}" >
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Tgl Daftar <span class="text-danger">*</span></label>
						<input class="form-control" type="date" name="tgl_daftar" value="{{ old('tgl_daftar', $row->tgl_daftar) }}" >
					</div>
					<div class="form-group">
						<label>Tgl Lahir <span class="text-danger">*</span></label>
						<input class="form-control" type="date" name="tgl_lahir" value="{{ old('tgl_lahir', $row->tgl_lahir) }}" >
					</div>
					<div class="form-group">
						<label>Unit Asal <span class="text-danger">*</span></label>
						{{-- <select class="form-control" name="unitasal">
								<option value="">- Selected -</option>
							@foreach($unitasal as $unit)
								<option value="{{$unit->kode_crips}}" {{ old('unitasal', $unit->kode_crips) == $row->kode_crips ? 'selected' : '' }}>{{$unit->nama_crips}}</option>
							@endforeach
						</select> --}}
						<select class="form-control" name="unit_asal">
							<option value="">- Selected -</option>
							<option value="igd" {{ old('unit_asal', $row->unit_asal) == 'igd' ? 'selected' : '' }}>IGD</option>
							<option value="rawatjalan" {{ old('unit_asal', $row->unit_asal) == 'rawatjalan' ? 'selected' : '' }}>Rawat Jalan</option>
							<option value="rawatinap" {{ old('unit_asal', $row->unit_asal) == 'rawatinap' ? 'selected' : '' }}>Rawat Inap</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<a class="btn btn-danger" href="{{URL('alternatif')}}"><i class="fa fa-backward"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection