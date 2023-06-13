<?php

namespace App\Http\Controllers;

use App\Models\Crips;
use Illuminate\Http\Request;

class CripsController extends Controller
{
    public function cetak()
    {
        $data['title'] = 'Laporan Data Crips';
        $data['rows'] = Crips::orderBy('kode_crips')->get();
        return view('crips.cetak', $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Data Crips';
        $data['limit'] = 10;
        $data['rows'] = Crips::where('nama_crips', 'like', '%' . $data['q'] . '%')
            ->leftJoin('tb_kriteria', 'tb_kriteria.kode_kriteria', '=', 'tb_crips.kode_kriteria')
            ->orderBy('tb_kriteria.kode_kriteria')
            ->orderBy('kode_crips')
            ->paginate($data['limit'])->withQueryString();
        return view('crips.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Crips';
        return view('crips.create', $data);
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
            'kode_crips' => 'required|unique:tb_crips',
            'nama_crips' => 'required',
            'kode_kriteria' => 'required',
        ], [
            'kode_crips.required' => 'Kode crips harus diisi',
            'kode_crips.unique' => 'Kode crips harus unik',
            'nama_crips.required' => 'Nama crips harus diisi',
            'kode_kriteria.required' => 'Kriteria harus diisi',
        ]);
        $crips = new Crips($request->all());
        $crips->save();

        query("INSERT INTO tb_rel_crips(ID1, ID2, nilai) SELECT '$crips->kode_crips', kode_crips, 1 FROM tb_crips");
        query("INSERT INTO tb_rel_crips(ID1, ID2, nilai) SELECT kode_crips, '$crips->kode_crips', 1 FROM tb_crips WHERE kode_crips<>'$crips->kode_crips'");
        return redirect('crips')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Crips  $crips
     * @return \Illuminate\Http\Response
     */
    public function show(Crips $crips)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Crips  $crips
     * @return \Illuminate\Http\Response
     */
    public function edit(string $crips)
    {
        $crips = Crips::findOrFail($crips);
        $data['row'] = $crips;
        $data['title'] = 'Ubah Crips';
        return view('crips.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Crips  $crips
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $crips)
    {
        $request->validate([
            'nama_crips' => 'required',
            'kode_kriteria' => 'required',
        ], [
            'nama_crips.required' => 'Nama crips harus diisi',
            'kode_kriteria.required' => 'Kriteria harus diisi',
        ]);
        $crips = Crips::findOrFail($crips);
        $crips->nama_crips = $request->nama_crips;
        $crips->kode_kriteria = $request->kode_kriteria;
        $crips->save();
        return redirect('crips')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Crips  $crips
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $crips)
    {
        $crips = Crips::findOrFail($crips);
        $crips->delete();
        query("DELETE FROM tb_rel_crips WHERE ID1 NOT IN (SELECT kode_crips FROM tb_crips) OR ID2 NOT IN (SELECT kode_crips FROM tb_crips)");
        return redirect('crips')->with('message', 'Data berhasil dihapus!');
    }
}
