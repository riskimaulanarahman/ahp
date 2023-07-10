@extends('layout.app')
@section('title', $title)
@section('content')
{{ show_msg() }}
<div class="card card-primary card-outline">
	<div class="card-header">
	</div>
	<div class="card-body p-0 table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<th>Bulan</th>
				<th>Jumlah Pasien</th>
				<th>Jumlah Pengajuan</th>
				<th>Jumlah Tindakan</th>
				<th>Jumlah Dirujuk Alasan Sarpras</th>
				<th>Jumlah Dirujuk Alasan Klinis</th>
			</thead>
			@foreach($rows as $row)
			<tr>
				<td>{{ $row['tahun'] }}</td>
				<td>{{ $row['total_pasien'] }}</td>
				<td>{{ $row['total_pengajuan'] }}</td>
				<td>{{ $row['total_tindakan'] }}</td>
				<td>{{ $row['total_rujuksarpas'] }}</td>
				<td>{{ $row['total_rujukklinis'] }}</td>
			</tr>
			@endforeach
		</table>
	</div>

</div>
@endsection