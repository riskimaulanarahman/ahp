<?php

namespace App\Http\Controllers;

use AHP;
use App\Models\Crips;
use Illuminate\Http\Request;

class Rel_CripsController extends Controller
{
    function index(Request $request)
    {
        $data['title'] = 'Bobot Crips';
        $data['kode_kriteria'] = $request->get('kode_kriteria');
        $data['rel_crips'] = get_rel_crips($data['kode_kriteria']);
        $data['ahp'] = new AHP($data['rel_crips']);
        $data['cripss'] = get_crips();
        foreach ($data['ahp']->prioritas as $key => $val) {
            $crips = Crips::find($key);
            $crips->bobot_crips = $val;
            $crips->save();
        }
        return view('rel_crips.index', $data);
    }

    function simpan(Request $request)
    {
        if ($request->ID1 == $request->ID2 && $request->nilai != 1)
            return back()->withInput()->withErrors([
                'nilai' => 'Crips yang sama harus bernilai 1!',
            ]);

        query("UPDATE tb_rel_crips SET nilai='$request->nilai' WHERE ID1='$request->ID1' AND ID2='$request->ID2'");
        $nilai = 1 / $request->nilai;
        query("UPDATE tb_rel_crips SET nilai='$nilai' WHERE ID1='$request->ID2' AND ID2='$request->ID1'");

        return redirect()->route('rel_crips.index', ['kode_kriteria' => $request->kode_kriteria])->withInput()->with('message', 'Data berhasil diubah!');
    }
}
