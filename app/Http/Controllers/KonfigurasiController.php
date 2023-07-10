<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konfigurasi;

class KonfigurasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['row'] = Konfigurasi::findOrFail(1);
        $data['title'] = 'Data Konfigurasi';
        return view('konfigurasi.index', $data);
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
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Kriteria $kriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(string $kriteria)
    {
        $data['row'] = Kriteria::findOrFail($kriteria);
        $data['title'] = 'Ubah Kriteria';
        return view('kriteria.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $kriteria = Konfigurasi::findOrFail(1);
        $kriteria->jml_mesin = $request->jml_mesin;
        $kriteria->jml_mesinopr = $request->jml_mesinopr;
        $kriteria->jml_shift = $request->jml_shift;
        $kriteria->save();
        return redirect('konfigurasi')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $kriteria)
    {
        $kriteria = Kriteria::findOrFail($kriteria);
        $kriteria->delete();
        query("DELETE FROM tb_rel_alternatif WHERE kode_kriteria NOT IN (SELECT kode_kriteria FROM tb_kriteria)");
        query("DELETE FROM tb_rel_kriteria WHERE ID1 NOT IN (SELECT kode_kriteria FROM tb_kriteria) OR ID2 NOT IN (SELECT kode_kriteria FROM tb_kriteria)");
        return redirect('kriteria')->with('message', 'Data berhasil dihapus!');
    }
}
