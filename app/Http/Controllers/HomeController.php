<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\User;
use App\Models\Tindakan;
use App\Models\Konfigurasi;

class HomeController extends Controller
{
    public function show()
    {
        $data['title'] = 'Home';
        $data['total_pasien'] = Alternatif::count();
        $data['total_tindakan'] = Tindakan::count();
        $currentYear = date('Y'); // Mendapatkan tahun berjalan
        $data['yearly_tindakan'] = Tindakan::whereYear('tgl_tindakan', $currentYear)->count();
        $data['total_tindakanklinis'] = Tindakan::where('status_tindakan', 3)->count();
        $data['total_tindakansarpras'] = Tindakan::where('status_tindakan', 4)->count();
        $data['yearly_tindakanklinis'] = Tindakan::where('status_tindakan', 3)->whereYear('tgl_tindakan', $currentYear)->count();
        $data['yearly_tindakansarpras'] = Tindakan::where('status_tindakan', 4)->whereYear('tgl_tindakan', $currentYear)->count();
        $data['total_mesin'] = Konfigurasi::sum('jml_mesin');
        $data['total_mesinopr'] = Konfigurasi::sum('jml_mesinopr');
        $data['total_shift'] = Konfigurasi::sum('jml_shift');

        $data['total_user'] = User::count();
        $data['rata_nilai'] = get_var("SELECT AVG(total) FROM tb_alternatif");

        $data['categories'] = array();
        foreach (Alternatif::all() as $row) {
            $data['categories'][$row->nama_alternatif] = $row->nama_alternatif;
            $data['series'][$row->nama_alternatif] = $row->total * 1;
        }
        $data['categories'] = array_values($data['categories']);
        $data['series'] = array_values($data['series']);

        // Initialize arrays
        $dialisis = [];
        $sarpras = [];
        $klinis = [];
        $tidaklayak = [];

        $dialisis2 = [];
        $sarpras2 = [];
        $klinis2 = [];
        $tidaklayak2 = [];

        // Define options
        $options = ['igd', 'rawatjalan', 'rawatinap'];

        $previousYear = $currentYear - 1;

        // Retrieve data for all statuses
        $queryTindakannow = Tindakan::select('unit_asal', 'status_tindakan', \DB::raw('COUNT(*) as total'))
            ->whereIn('status_tindakan', [1, 3, 4, 5])
            ->whereYear('tgl_tindakan',$currentYear)
            ->groupBy('unit_asal', 'status_tindakan')
            ->get();

        $queryTindakanless = Tindakan::select('unit_asal', 'status_tindakan', \DB::raw('COUNT(*) as total'))
            ->whereIn('status_tindakan', [1, 3, 4, 5])
            ->whereYear('tgl_tindakan',$previousYear)
            ->groupBy('unit_asal', 'status_tindakan')
            ->get();

        // Populate arrays
        foreach ($queryTindakannow as $tindakan) {
            $unit = $tindakan->unit_asal;
            $status = $tindakan->status_tindakan;
            $total = $tindakan->total;

            if (!isset($dialisis[$unit])) {
                $dialisis[$unit] = 0;
            }
            if (!isset($sarpras[$unit])) {
                $sarpras[$unit] = 0;
            }
            if (!isset($klinis[$unit])) {
                $klinis[$unit] = 0;
            }
            if (!isset($tidaklayak[$unit])) {
                $tidaklayak[$unit] = 0;
            }

            if ($status == 1) {
                $dialisis[$unit] += $total;
            } elseif ($status == 3) {
                $klinis[$unit] += $total;
            } elseif ($status == 4) {
                $sarpras[$unit] += $total;
            } elseif ($status == 5) {
                $tidaklayak[$unit] += $total;
            }
        }

        // Add missing options to arrays
        foreach ($options as $option) {
            if (!isset($dialisis[$option])) {
                $dialisis[$option] = 0;
            }
            if (!isset($sarpras[$option])) {
                $sarpras[$option] = 0;
            }
            if (!isset($klinis[$option])) {
                $klinis[$option] = 0;
            }
            if (!isset($tidaklayak[$option])) {
                $tidaklayak[$option] = 0;
            }
        }

        // Populate arrays
        foreach ($queryTindakanless as $tindakan) {
            $unit = $tindakan->unit_asal;
            $status = $tindakan->status_tindakan;
            $total = $tindakan->total;

            if (!isset($dialisis2[$unit])) {
                $dialisis2[$unit] = 0;
            }
            if (!isset($sarpras2[$unit])) {
                $sarpras2[$unit] = 0;
            }
            if (!isset($klinis2[$unit])) {
                $klinis2[$unit] = 0;
            }
            if (!isset($tidaklayak2[$unit])) {
                $tidaklayak2[$unit] = 0;
            }

            if ($status == 1) {
                $dialisis2[$unit] += $total;
            } elseif ($status == 3) {
                $klinis2[$unit] += $total;
            } elseif ($status == 4) {
                $sarpras2[$unit] += $total;
            } elseif ($status == 5) {
                $tidaklayak2[$unit] += $total;
            }
        }

        // Add missing options to arrays
        foreach ($options as $option) {
            if (!isset($dialisis2[$option])) {
                $dialisis2[$option] = 0;
            }
            if (!isset($sarpras2[$option])) {
                $sarpras2[$option] = 0;
            }
            if (!isset($klinis2[$option])) {
                $klinis2[$option] = 0;
            }
            if (!isset($tidaklayak2[$option])) {
                $tidaklayak2[$option] = 0;
            }
        }

        ksort($dialisis);
        ksort($sarpras);
        ksort($klinis);
        ksort($tidaklayak);

        ksort($dialisis2);
        ksort($sarpras2);
        ksort($klinis2);
        ksort($tidaklayak2);


        $data['dialisisnow'] = array_values($dialisis);
        $data['sarprasnow'] = array_values($sarpras);
        $data['klinisnow'] = array_values($klinis);
        $data['tidaklayaknow'] = array_values($tidaklayak);
        $data['dialisisless'] = array_values($dialisis2);
        $data['sarprasless'] = array_values($sarpras2);
        $data['klinisless'] = array_values($klinis2);
        $data['tidaklayakless'] = array_values($tidaklayak2);

        $data['dialisis'] = array_merge($data['dialisisnow'], $data['dialisisless']);
        $data['sarpras'] = array_merge($data['sarprasnow'], $data['sarprasless']);
        $data['klinis'] = array_merge($data['klinisnow'], $data['klinisless']);
        $data['tidaklayak'] = array_merge($data['tidaklayaknow'], $data['tidaklayakless']);

        $months = range(1, 12); // Daftar bulan dari 1 hingga 12
        $status_tindakan = [1 => 'dialisis', 4 => 'dirujukalasansarpras', 3 => 'dirujukalasanklinis', 5 => 'tidaklayakhd'];

        $querybulanannow = Tindakan::selectRaw('MONTH(tgl_tindakan) as month, unit_asal, status_tindakan, COUNT(*) as total')
            ->whereIn('status_tindakan', array_keys($status_tindakan))
            ->whereYear('tgl_tindakan', $currentYear)
            ->groupBy('month', 'unit_asal', 'status_tindakan')
            ->orderBy('month')
            ->get();

        $querybulananless = Tindakan::selectRaw('MONTH(tgl_tindakan) as month, unit_asal, status_tindakan, COUNT(*) as total')
            ->whereIn('status_tindakan', array_keys($status_tindakan))
            ->whereYear('tgl_tindakan', $previousYear)
            ->groupBy('month', 'unit_asal', 'status_tindakan')
            ->orderBy('month')
            ->get();

        // Generate daftar bulan dalam satu tahun
        // $monthlyData = [];
        // foreach ($months as $month) {
        //     $monthlyData[$month] = array_fill_keys($options, 0);
        // }

        // // Merge hasil query dengan daftar bulan dan unit asal
        // foreach ($querybulanannow as $item) {
        //     $month = $item->month;
        //     $unit = $item->unit_asal;
        //     $total = $item->total;

        //     $monthlyData[$month][$unit] += $total;
        // }
        $monthlyData = [];
        foreach ($months as $month) {
            $monthlyData[$month] = array_fill_keys(array_values($status_tindakan), 0);
        }

        // Merge hasil query dengan daftar bulan dan status tindakan
        foreach ($querybulanannow as $item) {
            $month = $item->month;
            $status = $item->status_tindakan;
            $total = $item->total;

            $monthlyData[$month][$status_tindakan[$status]] += $total;
        }

        $monthlyDataless = [];
        foreach ($months as $month) {
            $monthlyDataless[$month] = array_fill_keys(array_values($status_tindakan), 0);
        }

        // Merge hasil query dengan daftar bulan dan status tindakan
        foreach ($querybulananless as $item) {
            $month = $item->month;
            $status = $item->status_tindakan;
            $total = $item->total;

            $monthlyDataless[$month][$status_tindakan[$status]] += $total;
        }

        // Generate daftar bulan dalam satu tahun
        // $monthlyDataless = [];
        // foreach ($months as $month) {
        //     $monthlyDataless[$month] = array_fill_keys($options, 0);
        // }

        // // Merge hasil query dengan daftar bulan dan unit asal
        // foreach ($querybulananless as $item) {
        //     $month = $item->month;
        //     $unit = $item->unit_asal;
        //     $total = $item->total;

        //     $monthlyDataless[$month][$unit] += $total;
        // }

        $data['resultbulanannow'] = $monthlyData;
        $data['resultbulananless'] = $monthlyDataless;

        $data['resultbulanan'] = array_merge($monthlyData,$monthlyDataless);


        

        // return $data['resultbulanan'];
        


        return view('home', $data);
    }

    public function message()
    {
        $data['title'] = 'Informasi';
        return view('message', $data);
    }
}
