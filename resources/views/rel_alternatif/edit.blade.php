@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('rel_alternatif.update', $row) }}" method="post">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{show_error($errors)}}
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<div class="form-group">
						<label>NRM <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="kode_alternatif" value="{{ old('kode_alternatif', $row->kode_alternatif) }}" readonly>
					</div>
					<div class="form-group">
						<label>Nama Pasien <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama_alternatif" value="{{ old('nama_alternatif', $row->nama_alternatif) }}" readonly>
					</div>
				</div>
				<div class="col-md-6">
					<div class="col-md-6">
						<div class="form-group">
							<label>Tgl Pengajuan <span class="text-danger">*</span></label>
							<input class="form-control" type="date" name="tgl_pengajuan" value="{{ old('tgl_pengajuan', $rows->tgl_pengajuan) }}" >
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Jam Pengajuan <span class="text-danger">*</span></label>
							<input class="form-control" type="time" name="jam_pengajuan" value="{{ old('jam_pengajuan', $rows->jam_pengajuan) }}" >
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Jenis Tindakan <span class="text-danger">*</span></label>
							<select class="form-control" name="jenis_tindakan">
								<option value="">- Selected -</option>
								<option value="inisiasi" {{ old('jenis_tindakan', $rows->jenis_tindakan) == 'inisiasi' ? 'selected' : '' }}>Inisiasi</option>
								<option value="reguler" {{ old('jenis_tindakan', $rows->jenis_tindakan) == 'reguler' ? 'selected' : '' }}>Reguler</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-6">
					<p><h2>Penilaian :</h2></p>
					@foreach($nilais as $nilai)
					<div class="form-group">
						<label> {{ $nilai->nama_kriteria }} </label>
						<select class="form-control" name="nilai[{{ $nilai->ID }}]">
							<?= get_crips_option($nilai->kode_kriteria, $nilai->kode_crips) ?>
						</select>
					</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<button type="button" id="btnajukan" class="btn btn-warning" onclick="ajukan('{{$row->kode_alternatif}}')"><i class="fa fa-upload"></i> Ajukan</button>
			<a class="btn btn-danger" href="{{URL('rel_alternatif')}}"><i class="fa fa-backward"></i> Kembali</a>
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
