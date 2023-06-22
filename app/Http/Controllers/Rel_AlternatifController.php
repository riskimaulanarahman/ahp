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
        $data['title'] = 'Pengajuan Jadwal HD';
        $data['limit'] = 10;
        $data['rows'] = Alternatif::select('tb_alternatif.*','tb_rel_alternatif.tgl_pengajuan','tb_rel_alternatif.jam_pengajuan','tb_rel_alternatif.jenis_tindakan')
            ->where('nama_alternatif', 'like', '%' . $data['q'] . '%')
            ->leftJoin('tb_rel_alternatif','tb_alternatif.kode_alternatif','tb_rel_alternatif.kode_alternatif')
            ->orderBy('kode_alternatif')
            ->paginate($data['limit'])->withQueryString();
        $data['rel_alternatif'] = get_rel_alternatif();
        $data['crips'] = get_crips();
        $data['kriterias'] = get_kriteria();

        // dd($data[]);
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
        $data['rows'] = Rel_Alternatif::where('kode_alternatif', $alternatif)->first();
        $data['nilais'] = get_results("SELECT * FROM tb_rel_alternatif r INNER JOIN tb_kriteria k ON k.kode_kriteria=r.kode_kriteria WHERE kode_alternatif='$alternatif'");
        $data['title'] = 'Pengajuan Jadwal HD';
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
        // dd($request);
        // return false;
        $request->validate([
            'nilai.*' => 'required',
        ], [
            'nilai.*.required' => 'Nilai :attribute harus diisi',
        ]);
        $alternatif = Rel_Alternatif::where('kode_alternatif',$request->kode_alternatif)->first();
        $alternatif->tgl_pengajuan = $request->tgl_pengajuan;
        $alternatif->jam_pengajuan = $request->jam_pengajuan;
        $alternatif->jenis_tindakan = $request->jenis_tindakan;
        $alternatif->save();
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
