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
        // $data['q'] = $request->input('q');
        // $data['title'] = 'Data Konfigurasi';
        // $data['limit'] = 10;
        // $data['rows'] = Kriteria::where('nama_kriteria', 'like', '%' . $data['q'] . '%')
        //     ->orderBy('kode_kriteria')
        //     ->paginate($data['limit'])->withQueryString();
        // return view('konfigurasi.index', $data);
        // return 'sss';
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
        $data['title'] = 'Tambah Kriteria';
        return view('kriteria.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_kriteria' => 'required|unique:tb_kriteria',
            'nama_kriteria' => 'required',
        ], [
            'kode_kriteria.required' => 'Kode kriteria harus diisi',
            'kode_kriteria.unique' => 'Kode kriteria harus unik',
            'nama_kriteria.required' => 'Nama kriteria harus diisi',
        ]);
        $kriteria = new Kriteria($request->all());
        $kriteria->save();

        query("INSERT INTO tb_rel_alternatif (kode_alternatif, kode_kriteria) SELECT kode_alternatif, ? FROM tb_alternatif", [$kriteria->kode_kriteria]);
        query("INSERT INTO tb_rel_kriteria(ID1, ID2, nilai) SELECT '$kriteria->kode_kriteria', kode_kriteria, 1 FROM tb_kriteria");
        query("INSERT INTO tb_rel_kriteria(ID1, ID2, nilai) SELECT kode_kriteria, '$kriteria->kode_kriteria', 1 FROM tb_kriteria WHERE kode_kriteria<>'$kriteria->kode_kriteria'");
        return redirect('kriteria')->with('message', 'Data berhasil ditambah!');
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
    public function update(Request $request, string $kriteria)
    {
        // $request->validate([
        //     'nama_kriteria' => 'required',
        // ], [
        //     'nama_kriteria.required' => 'Nama kriteria harus diisi',
        // ]);
        $kriteria = Konfigurasi::findOrFail(1);
        $kriteria->jml_mesin = $request->jml_mesin;
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