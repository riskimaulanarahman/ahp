<?php

namespace App\Http\Controllers;

use AHP;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class Rel_KriteriaController extends Controller
{
    function index(Request $request)
    {
        $data['title'] = 'Bobot Kriteria';
        $data['rel_kriteria'] = get_rel_kriteria();
        $data['ahp'] = new AHP($data['rel_kriteria']);
        $data['kriterias'] = get_kriteria();

        foreach ($data['ahp']->prioritas as $key => $val) {
            $kriteria = Kriteria::find($key);
            $kriteria->bobot = $val;
            $kriteria->save();
        }
        return view('rel_kriteria.index', $data);
    }

    function simpan(Request $request)
    {
        if ($request->ID1 == $request->ID2 && $request->nilai != 1)
            return back()->withInput()->withErrors([
                'nilai' => 'Kriteria yang sama harus bernilai 1!',
            ]);

        query("UPDATE tb_rel_kriteria SET nilai='$request->nilai' WHERE ID1='$request->ID1' AND ID2='$request->ID2'");
        $nilai = 1 / $request->nilai;
        query("UPDATE tb_rel_kriteria SET nilai='$nilai' WHERE ID1='$request->ID2' AND ID2='$request->ID1'");

        return redirect('rel_kriteria')->withInput()->with('message', 'Data berhasil diubah!');
    }
}
