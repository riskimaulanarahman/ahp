<?php

namespace App\Http\Controllers;

use AHP;
use App\Models\Alternatif;
use App\Models\Kriteria;

class HitungController extends Controller
{
    function index()
    {
        /** memanggil data bobot kriteria dalam bentuk matriks AHP */
        $data['rel_kriteria'] = get_rel_kriteria();
        /** melakukan perhitungan ahp berdasarkan matriks AHP kriteria */
        $data['ahp'] = new AHP($data['rel_kriteria']);

        /** jika tidak konsisten, akan diarahkan route dengan pesan */
        if ($data['ahp']->konsistensi != 'Konsisten')
            return redirect()->route('message')->with('message', 'Perbandingan kriteria tidak konsisten. Silahkan hubungi Admin.');

        /** mengambil semua data kriteria */
        $kriteria = Kriteria::all();
        /** perulangan sesuai data kriteria */
        foreach ($kriteria as $row) {
            /** memanggil data bobot crisp per kriteria */
            $data['rel_crips'] = get_rel_crips($row->kode_kriteria);
            /** melakukan perhitungan ahp sesuai matriks crisp */
            $data['ahp'] = new AHP($data['rel_crips']);

            /** jika tidak konsisten, akan diarahkan route dengan pesan */
            if ($data['ahp']->konsistensi != 'Konsisten')
                return redirect()->route('message')->with('message', "Perbandingan sub kriteria <b>$row->nama_kriteria</b> tidak konsisten. Silahkan hubungi Admin.");
        }

        /** memanggil data bobot alternatif */
        $data['rel_alternatif'] = get_rel_alternatif();
        /** memanggil data semua crisp */
        $data['crips'] = get_crips();
        /** menyimpan nilai alterantif berdasarkan nilai prioritas crisp itu */
        $data['rel_nilai'] = array();
        /** perulangan sesuai jumlah alternatif */
        foreach ($data['rel_alternatif'] as $key => $val) {
            /** perulangan sejumlah kriteria */
            foreach ($val as $k => $v) {
                //mengisi rel_crisp dengan nilai prioritas sub
                $data['rel_nilai'][$key][$k] = isset($data['crips'][$v]) ? $data['crips'][$v]->bobot_crips : 0;
                //mengisi rel_crisp dengan nama sub
                $data['rel_alternatif'][$key][$k] = isset($data['crips'][$v]) ? $data['crips'][$v]->nama_crips : 0;
            }
        }

        /** tempat menyimpan bobot prioritas kriteria */
        $bobot = array();
        foreach ($kriteria as $row) {
            $bobot[$row->kode_kriteria] = $row->bobot;
            /** menyimpan data semua kriteria dengan key kode_kriteria */
            $data['kriterias'][$row->kode_kriteria] = $row;
        }
        /** perulangan sesuai jumlah alternatif */
        foreach ($data['rel_nilai'] as $key => $val) {
            /** perulangan sejumlah kriteria */
            foreach ($val as $k => $v) {
                /** mengalikan nilai alternatif dengan bobot kriteria */
                $data['terbobot'][$key][$k] = $v * $bobot[$k];
            }
            /** mentotalkan data terbobot setiap alternatif */
            $data['total'][$key] = array_sum($data['terbobot'][$key]);
        }

        /** mencari rangking berdasarkan total */
        $data['rank'] = $this->rank($data['total']);
        foreach ($data['rank'] as $key => $val) {
            /** simpan rangking dan total ke database (tb_alternatif) */
            query("UPDATE tb_alternatif SET total='{$data['total'][$key]}', rank='{$data['rank'][$key]}' WHERE kode_alternatif='$key'");
        }
        /** menyimpan data semua alternatif */
        $data['alternatifs'] = get_alternatif();
        $data['title'] = 'Perhitungan';

        return view('hitung.index', $data);
    }

    /** fungsi perangkingan */
    function rank($data)
    {
        arsort($data);
        $no = 0;
        $arr = array();
        $temp_val = null;
        /** mengurutkan dari total terbesar ke terkecil */
        foreach ($data as $key => $val) {
            if ($val != $temp_val) {
                $temp_val = $val;
                $no++;
            }
            $arr[$key] = $no;
        }

        //mengelompokkan rangking yang sama (total yang sama)
        $arr2 = array();
        foreach ($arr as $key => $val) {
            $arr2[$val][$key] = $key;
        }
        $rank = array();
        $no = 1;
        //jika rangking sama, maka kode diurutkan dari kecil ke besar
        foreach ($arr2 as $key => $val) {
            asort($val);
            foreach ($val as $k => $v) {
                $rank[$k] = $no++;
            }
        }
        return $rank;
    }

    function cetak()
    {
        $data['title'] = 'Laporan Hasil Perhitungan';
        $data['rows'] = Alternatif::orderBy('rank')->get();
        return view('hitung.cetak', $data);
    }
}
