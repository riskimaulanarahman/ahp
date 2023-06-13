<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\User;

class HomeController extends Controller
{
    public function show()
    {
        $data['title'] = 'Home';
        $data['total_alternatif'] = Alternatif::count();
        $data['total_kriteria'] = Kriteria::count();
        $data['total_user'] = User::count();
        $data['rata_nilai'] = get_var("SELECT AVG(total) FROM tb_alternatif");

        $data['categories'] = array();
        foreach (Alternatif::all() as $row) {
            $data['categories'][$row->nama_alternatif] = $row->nama_alternatif;
            $data['series'][$row->nama_alternatif] = $row->total * 1;
        }
        $data['categories'] = array_values($data['categories']);
        $data['series'] = array_values($data['series']);

        return view('home', $data);
    }

    public function message()
    {
        $data['title'] = 'Informasi';
        return view('message', $data);
    }
}
