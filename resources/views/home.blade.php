@extends('layout.app')
@section('title', $title)
@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card bg-primary">
            <div class="card-header">
                Total User
            </div>
            <div class="card-body">
                <span style="font-size: 35px;"><i class="fa fa-user"></i> {{ $total_user }} </span>
            </div>
            <div class="card-footer text-right" {{ is_hidden('user.index') }}>
                <a class="text-light" href="{{ route('user.index') }}">Selengkapnya <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info">
            <div class="card-header">
                Total Alternatif
            </div>
            <div class="card-body">
                <span style="font-size: 35px;"><i class="fa fa-user-alt"></i> {{ $total_alternatif }} </span>
            </div>
            <div class="card-footer text-right" {{ is_hidden('alternatif.index') }}>
                <a class="text-light" href="{{ route('alternatif.index') }}">Selengkapnya <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success">
            <div class="card-header">
                Total Kriteria
            </div>
            <div class="card-body">
                <span style="font-size: 35px;"><i class="fa fa-th"></i> {{ $total_kriteria }} </span>
            </div>
            <div class="card-footer text-right" {{ is_hidden('kriteria.index') }}>
                <a class="text-light" href="{{ route('kriteria.index') }}">Selengkapnya <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning">
            <div class="card-header">
                Rata-Rata Hasil
            </div>
            <div class="card-body">
                <span style="font-size: 35px;"><i class="fa fa-signal"></i> {{ round($rata_nilai, 4) }} </span>
            </div>
            <div class="card-footer text-right" {{ is_hidden('hitung.index') }}>
                <a class="text-light" href="{{ route('hitung.index') }}">Selengkapnya <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('adminlte3/plugins/highcharts/highcharts.js') }}"></script>
<script src="{{ asset('adminlte3/plugins/highcharts/modules/exporting.js') }}"></script>
<script src="{{ asset('adminlte3/plugins/highcharts/modules/export-data.js') }}"></script>
<script src="{{ asset('adminlte3/plugins/highcharts/modules/accessibility.js') }}"></script>

<div class="card">
    <div class="card-body">
        <div id="grafik"></div>
    </div>
</div>
<script>
    Highcharts.chart('grafik', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Hasil Perhitungan'
        },
        xAxis: {
            categories: <?= json_encode($categories) ?>,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Hasil'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.3f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Perhitungan',
            data: <?= json_encode($series) ?>

        }]
    });
</script>
@endsection