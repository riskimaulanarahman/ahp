@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('daftartindakan.update', $row->id) }}" method="post">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{show_error($errors)}}
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<div class="form-group">
						<label>Nama Pasien/NRM <span class="text-danger">*</span></label>
						<p>{{$row->nama_alternatif}}/{{$row->kode_alternatif}} (NIK : {{$row->nik}})</p>
						{{-- <input class="form-control" type="text" name="kode_alternatif" value="{{ old('kode_alternatif', $row->kode_alternatif) }}" readonly> --}}
					</div>
					{{-- <div class="form-group">
						<label>Nama Pasien <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama_alternatif" value="{{ old('nama_alternatif', $row->nama_alternatif) }}" readonly>
					</div> --}}
					<div class="form-group">
						<label>Unit Asal <span class="text-danger">*</span></label>
						<select class="form-control" name="unit_asal">
							<option value="">- Selected -</option>
							<option value="igd" {{ old('unit_asal', $row->unit_asal) == 'igd' ? 'selected' : '' }}>IGD</option>
							<option value="rawatjalan" {{ old('unit_asal', $row->unit_asal) == 'rawatjalan' ? 'selected' : '' }}>Rawat Jalan</option>
							<option value="rawatinap" {{ old('unit_asal', $row->unit_asal) == 'rawatinap' ? 'selected' : '' }}>Rawat Inap</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="col-md-6">
						<div class="form-group">
							<label>Tgl Tindakan <span class="text-danger">*</span></label>
							<input class="form-control" type="date" name="tgl_tindakan" value="{{ old('tgl_tindakan', $row->tgl_tindakan) }}" >
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Jam Tindakan <span class="text-danger">*</span></label>
							<input class="form-control" type="time" name="jam_tindakan" value="{{ old('jam_tindakan', $row->jam_tindakan) }}" >
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Shift <span class="text-danger">*</span></label>
							<input class="form-control" min=1 max=3 type="number" name="shift" value="{{ old('tgl_tindakan', $row->shift) }}">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Jenis Tindakan <span class="text-danger">*</span></label>
							<select class="form-control" name="jenis_tindakan">
								<option value="">- Selected -</option>
								<option value="inisiasi" {{ old('jenis_tindakan', $row->jenis_tindakan) == 'inisiasi' ? 'selected' : '' }}>Inisiasi</option>
								<option value="reguler" {{ old('jenis_tindakan', $row->jenis_tindakan) == 'reguler' ? 'selected' : '' }}>Reguler</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Status Tindakan <span class="text-danger">*</span></label>
							<select class="form-control" name="status_tindakan">
								<option value="">- Selected -</option>
								<option value="1" {{ old('status_tindakan', $row->status_tindakan) == '1' ? 'selected' : '' }}>Dialisis</option>
								<option value="2" {{ old('status_tindakan', $row->status_tindakan) == '2' ? 'selected' : '' }}>Tidak Hadir</option>
								<option value="3" {{ old('status_tindakan', $row->status_tindakan) == '3' ? 'selected' : '' }}>Dirujuk alasan klinis</option>
								<option value="4" {{ old('status_tindakan', $row->status_tindakan) == '4' ? 'selected' : '' }}>Dirujuk alasan sarpras</option>
								<option value="5" {{ old('status_tindakan', $row->status_tindakan) == '5' ? 'selected' : '' }}>Tidak layak HD</option>
								<option value="6" {{ old('status_tindakan', $row->status_tindakan) == '6' ? 'selected' : '' }}>Jadwal ulang alasan klinis</option>
								<option value="7" {{ old('status_tindakan', $row->status_tindakan) == '7' ? 'selected' : '' }}>Jadwal ulang alasan sarpras</option>
							</select>
						</div>
					</div>
					
				</div>
			</div>
			<hr>
			{{-- <div class="row">
				<div class="col-md-6">
					<p><h2>Penilaian :</h2></p>
					@foreach($nilais as $nilai)
					<div class="form-group">
						<label> {{ $nilai->nama_kriteria }} </label>
						<select class="form-control" name="nilai[{{ $nilai->ID }}]">
							<?= 
								// get_crips_option($nilai->kode_kriteria, $nilai->kode_crips) 
								?>
						</select>
					</div>
					@endforeach
				</div>
			</div> --}}
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			{{-- <button type="button" id="btnajukan" class="btn btn-warning" onclick="ajukan('{{$row->kode_alternatif}}')"><i class="fa fa-upload"></i> Ajukan</button> --}}
			<a class="btn btn-danger" href="{{URL('daftartindakan')}}"><i class="fa fa-backward"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection


<script>
	function ajukan(kode) {

		var confirmed = confirm("Apakah Anda Yakin ?");

		if (confirmed) {
			var xhr = new XMLHttpRequest();

			xhr.open('GET', '/api/updatestatus/'+kode+'?status=1', true);

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
