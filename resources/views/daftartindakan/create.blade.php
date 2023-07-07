@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ URL('daftartindakan') }}" method="POST">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{ show_error($errors) }}
					{{ csrf_field() }}
					<div class="form-group">
						<label>Nama Pasien/NRM <span class="text-danger">*</span></label>
						{{-- <input class="form-control" type="text" name="kode_alternatif"> --}}
						<select class="form-control" name="kode_alternatif" required>
							<option value="">- Selected -</option>
							@foreach($namapasien as $n)
								<option value="{{$n->kode_alternatif}}">{{$n->nama_alternatif}}/{{$n->kode_alternatif}} (NIK : {{$n->nik}})</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Unit Asal <span class="text-danger">*</span></label>
						<select class="form-control" name="unit_asal">
							<option value="">- Selected -</option>
							<option value="igd">IGD</option>
							<option value="rawatjalan">Rawat Jalan</option>
							<option value="rawatinap">Rawat Inap</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="col-md-6">
						<div class="form-group">
							<label>Tgl Tindakan <span class="text-danger">*</span></label>
							<input class="form-control" type="date" name="tgl_tindakan" >
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Jam Tindakan <span class="text-danger">*</span></label>
							<input class="form-control" type="time" name="jam_tindakan">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Shift <span class="text-danger">*</span></label>
							<input class="form-control" min=1 max=3 type="number" name="shift">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Jenis Tindakan <span class="text-danger">*</span></label>
							<select class="form-control" name="jenis_tindakan">
								<option value="">- Selected -</option>
								<option value="inisiasi">Inisiasi</option>
								<option value="reguler">Reguler</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Status Tindakan <span class="text-danger">*</span></label>
							<select class="form-control" name="status_tindakan">
								<option value="">- Selected -</option>
								<option value="1">Dialisis</option>
								<option value="2">Tidak Hadir</option>
								<option value="3">Dirujuk alasan klinis</option>
								<option value="4">Dirujuk alasan sarpras</option>
								<option value="5">Tidak layak HD</option>
								<option value="6">Jadwal ulang alasan klinis</option>
								<option value="7">Jadwal ulang alasan sarpras</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<a class="btn btn-danger" href="{{ route('daftartindakan.index') }}"><i class="fa fa-backward"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection