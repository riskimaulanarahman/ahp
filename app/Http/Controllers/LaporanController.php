<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Rel_Alternatif;
use App\Models\Tindakan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function laporanbulanan(Request $request)
    {
        $data['title'] = 'Laporan Bulanan';
      
        $months = [];
        for ($i = 0; $i < 12; $i++) {
            $month = Carbon::now()->subMonths($i)->format('Y-m');
            $months[] = $month;
        }

        $results = [];
        foreach ($months as $month) {
            $dateStart = Carbon::parse($month)->startOfMonth();
            $dateEnd = Carbon::parse($month)->endOfMonth();
            $year = Carbon::now()->year;

            $totalPasien = Alternatif::whereYear('tgl_daftar', $year)
                            ->whereBetween('tgl_daftar', [$dateStart, $dateEnd])
                            ->count();
            $totalPengajuan = Rel_Alternatif::whereYear('tgl_pengajuan', $year)
                            ->whereBetween('tgl_pengajuan', [$dateStart, $dateEnd])
                            ->count();
            $totalTindakan = Tindakan::whereYear('tgl_tindakan', $year)
                            ->whereBetween('tgl_tindakan', [$dateStart, $dateEnd])
                            ->count();
            $totalrujuksarpas = Tindakan::whereYear('tgl_tindakan', $year)
                            ->whereBetween('tgl_tindakan', [$dateStart, $dateEnd])
                            ->where('status_tindakan',4)
                            ->count();
            $totalrujuksarpas2 = Rel_Alternatif::whereYear('tgl_pengajuan', $year)
                            ->whereBetween('tgl_pengajuan', [$dateStart, $dateEnd])
                            ->where('status',4)
                            ->count();
            $totalrujukklinis = Tindakan::whereYear('tgl_tindakan', $year)
                            ->whereBetween('tgl_tindakan', [$dateStart, $dateEnd])
                            ->where('status_tindakan',3)
                            ->count();
            $totalrujukklinis2 = Rel_Alternatif::whereYear('tgl_pengajuan', $year)
                            ->whereBetween('tgl_pengajuan', [$dateStart, $dateEnd])
                            ->where('status',3)
                            ->count();

            $results[] = [
                'bulan' => $month,
                'total_pasien' => $totalPasien,
                'total_pengajuan' => $totalPengajuan,
                'total_tindakan' => $totalTindakan,
                'total_rujuksarpas' => $totalrujuksarpas + $totalrujuksarpas2,
                'total_rujukklinis' => $totalrujukklinis + $totalrujukklinis2,
            ];
        }

        $data['rows'] = $results;

        return view('laporan.bulanan', $data);
    }

    public function laporantahunan(Request $request)
    {
        $data['title'] = 'Laporan Tahunan';
      
        // $year = Carbon::now()->year;
        // $months = Carbon::now()->subYear()->monthsUntil(Carbon::now());
        $years = [2021,2022,2023];

        $results = [];
        foreach ($years as $year) {

            $totalPasien = Alternatif::whereYear('tgl_daftar', $year)
                            ->count();
            $totalPengajuan = Rel_Alternatif::whereYear('tgl_pengajuan', $year)
                            ->count();
            $totalTindakan = Tindakan::whereYear('tgl_tindakan', $year)
                            ->count();
            $totalRujukSarPas = Tindakan::whereYear('tgl_tindakan', $year)
                            ->where('status_tindakan', 4)
                            ->count();
            $totalRujukSarPas2 = Rel_Alternatif::whereYear('tgl_pengajuan', $year)
                            ->where('status', 4)
                            ->count();
            $totalRujukklinis = Tindakan::whereYear('tgl_tindakan', $year)
                            ->where('status_tindakan', 3)
                            ->count();
            $totalRujukklinis2 = Rel_Alternatif::whereYear('tgl_pengajuan', $year)
                            ->where('status', 3)
                            ->count();

            $results[] = [
                'tahun' => $year,
                'total_pasien' => $totalPasien,
                'total_pengajuan' => $totalPengajuan,
                'total_tindakan' => $totalTindakan,
                'total_rujuksarpas' => $totalRujukSarPas + $totalRujukSarPas2,
                'total_rujukklinis' => $totalRujukklinis + $totalRujukklinis2,
            ];
        }

        $data['rows'] = array_reverse($results);

        return view('laporan.tahunan', $data);
    }

   
}
