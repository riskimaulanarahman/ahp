@extends('layout.app')
@section('title', $title)
@section('content')
<div class="row">
    <div class="col-md-2">
        <div class="card bg-success">
            <div class="card-header">
                Total Pasien 2023
            </div>
            <div class="card-body">
                <center><span style="font-size: 35px;"> {{$total_pasien}} </span></center>
            </div>
            <div class="card-footer text-right" {{ is_hidden('alternatif.index') }}>
                <a class="text-light" href="{{ route('alternatif.index') }}">Selengkapnya <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-2">
        <div class="card bg-warning">
            <div class="card-header">
                Total Tindakan
            </div>
            <div class="card-body">
                <center><span style="font-size: 35px;"> {{$total_tindakan}} </span></center>
            </div>
            <div class="card-footer text-right" {{ is_hidden('daftartindakan.index') }}>
                <a class="text-light" href="{{ route('daftartindakan.index') }}">Selengkapnya <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    </div> --}}
    <div class="col-md-2">
        <div class="card bg-info">
            <div class="card-header">
                Total Tindakan {{ now()->format('Y') }}
            </div>
            <div class="card-body">
                <center><span style="font-size: 35px;"> {{$yearly_tindakan}} </span></center>
            </div>
            <div class="card-footer text-right" {{ is_hidden('daftartindakan.index') }}>
                <a class="text-light" href="{{ route('daftartindakan.index') }}">Selengkapnya <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-2">
        <div class="card bg-warning">
            <div class="card-header">
                Total Dirujuk
            </div>
            <div class="card-body">
                <span style="font-size: 16px;">Alasan Klinis : {{$total_tindakanklinis}} </span><br>
                <span style="font-size: 16px;">Alasan Sarpras : {{$total_tindakansarpras}} </span>
            </div>
            <div class="card-footer text-right" {{ is_hidden('daftartindakan.index') }}>
                <a class="text-light" href="{{ route('daftartindakan.index') }}">Selengkapnya <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    </div> --}}
    <div class="col-md-2">
        <div class="card bg-danger">
            <div class="card-header">
                Total Dirujuk {{ now()->format('Y') }}
            </div>
            <div class="card-body">
                <span style="font-size: 16px;">Alasan Klinis : {{$yearly_tindakanklinis}} </span><br>
                <span style="font-size: 16px;">Alasan Sarpras : {{$yearly_tindakansarpras}} </span>
            </div>
            <div class="card-footer text-right" {{ is_hidden('daftartindakan.index') }}>
                <a class="text-light" href="{{ route('daftartindakan.index') }}">Selengkapnya <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card bg-indigo">
            <div class="card-header">
                Data Sarpras
            </div>
            <div class="card-body">
                <span style="font-size: 16px;">Mesin : {{$total_mesin}} </span><br>
                <span style="font-size: 16px;">Mesin Beroperasi : {{$total_mesinopr}} </span><br>
                <span style="font-size: 16px;">Shift : {{$total_shift}} </span>
            </div>
            <div class="card-footer text-right" {{ is_hidden('konfigurasi.index') }}>
                <a class="text-light" href="{{ route('konfigurasi.index') }}">Selengkapnya <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-3">
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
    </div> --}}
</div>
<script src="{{ asset('adminlte3/plugins/highcharts/highcharts.js') }}"></script>
<script src="{{ asset('adminlte3/plugins/highcharts/modules/exporting.js') }}"></script>
<script src="{{ asset('adminlte3/plugins/highcharts/modules/export-data.js') }}"></script>
<script src="{{ asset('adminlte3/plugins/highcharts/modules/accessibility.js') }}"></script>

<div class="card">
    <div class="card-body">
        <div id="container"></div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div id="container2"></div>
    </div>
</div>
<script>
   
    const now = new Date();
    const currentYear = now.getFullYear();
    const previousYear = currentYear - 1;

    Highcharts.chart('container', {
        chart: {
            type: 'column',
            marginRight: 200 // Mengatur margin kanan untuk menyisakan ruang bagi legenda
        },
        title: {
            text: 'GRAFIK TAHUNAN LAYANAN HEMODIALISIS'
        },
        xAxis: {
            categories: [
                'IGD_'+currentYear, 
                'Rawat Inap_'+currentYear,
                'Rawat Jalan_'+currentYear,
                'IGD_'+previousYear,
                'Rawat Inap_'+previousYear,
                'Rawat Jalan_'+previousYear
            ]
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        legend: {
            align: 'right',
            verticalAlign: 'middle',
            layout: 'vertical'
        },
        series: [{
            name: 'Dialisis',
            data: <?= json_encode($dialisis) ?>
        }, {
            name: 'Dirujuk alasan sarpras',
            data: <?= json_encode($sarpras) ?>
        }, {
            name: 'Dirujuk alasan klinis',
            data: <?= json_encode($klinis) ?>
        }, {
            name: 'Tidak layak HD',
            data: <?= json_encode($tidaklayak) ?>
        }],
        credits: {
            enabled: false
        },
        plotOptions: {
            column: {
                grouping: true,
                shadow: false
            }
        }
    });

    // Highcharts.chart('container2', {
    //     chart: {
    //         type: 'column',
    //         marginRight: 200 // Mengatur margin kanan untuk menyisakan ruang bagi legenda
    //     },
    //     title: {
    //         text: 'GRAFIK BULANAN LAYANAN HEMODIALISIS'
    //     },
    //     xAxis: {
    //         categories: [
    //             'Jan_'+currentYear, 
    //             'Feb_'+currentYear,
    //             'Mar_'+currentYear,
    //             'Apr_'+currentYear,
    //             'May_'+currentYear,
    //             'Jun_'+currentYear,
    //             'Jul_'+currentYear,
    //             'Aug_'+currentYear,
    //             'Sep_'+currentYear,
    //             'Oct_'+currentYear,
    //             'Nov_'+currentYear,
    //             'Dec_'+currentYear,
    //             'Jan_'+previousYear, 
    //             'Feb_'+previousYear,
    //             'Mar_'+previousYear,
    //             'Apr_'+previousYear,
    //             'May_'+previousYear,
    //             'Jun_'+previousYear,
    //             'Jul_'+previousYear,
    //             'Aug_'+previousYear,
    //             'Sep_'+previousYear,
    //             'Oct_'+previousYear,
    //             'Nov_'+previousYear,
    //             'Dec_'+previousYear
    //         ]
    //     },
    //     yAxis: {
    //         min: 0,
    //         title: {
    //             text: ''
    //         }
    //     },
    //     legend: {
    //         align: 'right',
    //         verticalAlign: 'middle',
    //         layout: 'vertical'
    //     },
    //     series: [{
    //         name: 'Dialisis',
    //         data: [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1]
    //     }, {
    //         name: 'Dirujuk alasan sarpras',
    //         data: [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1]
    //     }, {
    //         name: 'Dirujuk alasan klinis',
    //         data: [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1]
    //     }, {
    //         name: 'Tidak layak HD',
    //         data: [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1]
    //     }],
    //     plotOptions: {
    //         column: {
    //             grouping: true,
    //             shadow: false
    //         }
    //     }
    // });
    var data = <?= json_encode($resultbulanan) ?>

    // Mendefinisikan kategori bulan
var monthCategories = [
    'Jan_'+currentYear,
    'Feb_'+currentYear,
    'Mar_'+currentYear,
    'Apr_'+currentYear,
    'May_'+currentYear,
    'Jun_'+currentYear,
    'Jul_'+currentYear,
    'Aug_'+currentYear,
    'Sep_'+currentYear,
    'Oct_'+currentYear,
    'Nov_'+currentYear,
    'Dec'+currentYear,
    'Jan_'+previousYear,
    'Feb_'+previousYear,
    'Mar_'+previousYear,
    'Apr_'+previousYear,
    'May_'+previousYear,
    'Jun_'+previousYear,
    'Jul_'+previousYear,
    'Aug_'+previousYear,
    'Sep_'+previousYear,
    'Oct_'+previousYear,
    'Nov_'+previousYear,
    'Dec'+previousYear,
];

// Mengubah data menjadi format yang dapat digunakan oleh Highcharts
var seriesData = Object.keys(data).map(function (month) {
  return [
    data[month].dialisis,
    data[month].dirujukalasansarpras,
    data[month].dirujukalasanklinis,
    data[month].tidaklayakhd,
  ];
});

// Konfigurasi chart
var options = {
  chart: {
    type: 'column',
    // marginRight: 200 // Mengatur margin kanan untuk menyisakan ruang bagi legenda
  },
  title: {
    text: 'GRAFIK BULANAN LAYANAN HEMODIALISIS'
  },
  xAxis: {
    categories: monthCategories
  },
    yAxis: {
        min: 0,
        title: {
            text: ''
        }
    },
    // legend: {
    //     align: 'right',
    //     verticalAlign: 'middle',
    //     layout: 'vertical'
    // },
    credits: {
        enabled: false
    },
  series: [
    { name: 'Dialisis', data: seriesData.map(function (data) { return data[0]; }) },
    { name: 'Dirujuk alasan sarpras', data: seriesData.map(function (data) { return data[1]; }) },
    { name: 'Dirujuk alasan klinis', data: seriesData.map(function (data) { return data[2]; }) },
    { name: 'Tidak layak HD', data: seriesData.map(function (data) { return data[3]; }) }
  ]
};

// Membuat chart menggunakan konfigurasi yang telah ditentukan
Highcharts.chart('container2', options);


</script>

@endsection