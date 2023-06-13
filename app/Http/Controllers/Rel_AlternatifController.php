<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Rel_Alternatif;
use Illuminate\Http\Request;

class Rel_AlternatifController extends Controller
{
    public function cetak()
    {
        $data['title'] = 'Laporan Data Nilai Alternatif';
        $data['rows'] = Alternatif::with(['nilais'])->orderBy('kode_alternatif')->get();
        $data['kriterias'] = Kriteria::all();
        return view('rel_alternatif.cetak', $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Nilai Alternatif';
        $data['limit'] = 10;
        $data['rows'] = Alternatif::where('nama_alternatif', 'like', '%' . $data['q'] . '%')
            ->orderBy('kode_alternatif')
            ->paginate($data['limit'])->withQueryString();
        $data['rel_alternatif'] = get_rel_alternatif();
        $data['crips'] = get_crips();
        $data['kriterias'] = get_kriteria();
        return view('rel_alternatif.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rel_Alternatif  $rel_Alternatif
     * @return \Illuminate\Http\Response
     */
    public function show(Rel_Alternatif $rel_Alternatif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rel_Alternatif  $rel_Alternatif
     * @return \Illuminate\Http\Response
     */
    public function edit(string $alternatif)
    {
        $data['row'] = Alternatif::findOrFail($alternatif);
        $data['nilais'] = get_results("SELECT * FROM tb_rel_alternatif r INNER JOIN tb_kriteria k ON k.kode_kriteria=r.kode_kriteria WHERE kode_alternatif='$alternatif'");
        $data['title'] = 'Ubah Nilai Alternatif';
        return view('rel_alternatif.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rel_Alternatif  $rel_Alternatif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rel_Alternatif $rel_Alternatif)
    {
        $request->validate([
            'nilai.*' => 'required',
        ], [
            'nilai.*.required' => 'Nilai :attribute harus diisi',
        ]);
        foreach ($request->nilai as $key => $val) {
            $rel_alternatif = Rel_Alternatif::find($key);
            $rel_alternatif->kode_crips = $val;
            $rel_alternatif->save();
        }
        return redirect('rel_alternatif')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rel_Alternatif  $rel_Alternatif
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rel_Alternatif $rel_Alternatif)
    {
        //
    }
}
