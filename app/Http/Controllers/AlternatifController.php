<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Rel_Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function detail_update(Request $request)
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
        return redirect()->route('alternatif.detail', ['kode_alternatif' => $request->kode_alternatif])->with('message', 'Data berhasil diubah!');
    }
    public function detail(Request $request)
    {
        $kode_alternatif = $request->get('kode_alternatif');
        $data['row'] = Alternatif::findOrFail($kode_alternatif);
        $data['nilais'] = get_results("SELECT * FROM tb_rel_alternatif r INNER JOIN tb_kriteria k ON k.kode_kriteria=r.kode_kriteria WHERE kode_alternatif='$kode_alternatif'");
        $data['title'] = 'Detail Kriteria';
        return view('alternatif.detail', $data);
    }

    public function cetak()
    {
        $data['title'] = 'Laporan Data Alternatif';
        $data['rows'] = Alternatif::orderBy('kode_alternatif')->get();
        return view('alternatif.cetak', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Pendaftaran Pasien';
        $data['limit'] = 25;
        $data['rows'] = Alternatif::where('nama_alternatif', 'like', '%' . $data['q'] . '%')
            ->orderBy('kode_alternatif')
            ->paginate($data['limit'])->withQueryString();
        return view('alternatif.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Pendaftaran Pasien';
        // $data['unitasal'] = get_results("SELECT * FROM tb_crips WHERE kode_kriteria = 'K05' ");
        return view('alternatif.create', $data);
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
            'kode_alternatif' => 'required|unique:tb_alternatif',
            'nik' => 'required|unique:tb_alternatif',
            'nama_alternatif' => 'required',
        ], [
            'kode_alternatif.required' => 'Kode harus diisi',
            'kode_alternatif.unique' => 'Kode harus unik',
            'nik.unique' => 'NIK sudah ada',
            'nama_alternatif.required' => 'Nama harus diisi',
        ]);
        $alternatif = new Alternatif($request->all());
        $alternatif->save();

        $relalt = query("INSERT INTO tb_rel_alternatif (kode_alternatif, kode_kriteria) SELECT ?, kode_kriteria FROM tb_kriteria", [$alternatif->kode_alternatif]);
        // $updrelalt = query("UPDATE tb_rel_alternatif set kode_crips='$request->unitasal' where kode_alternatif='$request->kode_alternatif' and kode_kriteria='K05'");

        // for ($i=1; $i <= 3; $i++) { 
        //     $shiftdata = query("INSERT INTO tb_shiftdata (kode_alternatif,hari,shift,value) VALUES ('$request->kode_alternatif',?,$i,0)");
        // }
        $hari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];

        foreach ($hari as $day) {
            for ($i = 1; $i <= 3; $i++) {
                $shiftdata = query("INSERT INTO tb_shiftdata (kode_alternatif, hari, shift, value) VALUES ('$request->kode_alternatif', '$day', $i, 0)");
            }
        }


        return redirect('alternatif')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function show(Alternatif $alternatif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function edit(Alternatif $alternatif)
    {
        $newalt = $alternatif->select('tb_alternatif.*','tb_rel_alternatif.kode_crips','tb_crips.nama_crips')
        ->leftJoin('tb_rel_alternatif','tb_alternatif.kode_alternatif','tb_rel_alternatif.kode_alternatif')
        ->leftJoin('tb_crips','tb_rel_alternatif.kode_crips','tb_crips.kode_crips')
        ->where('tb_alternatif.kode_alternatif',$alternatif->kode_alternatif)
        ->where('tb_rel_alternatif.kode_kriteria','K01')
        ->first();
        $data['row'] = $newalt;
        $data['title'] = 'Ubah Data Pasien';
        // $data['unitasal'] = get_results("SELECT * FROM tb_crips WHERE kode_kriteria = 'K05' ");

        return view('alternatif.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alternatif $alternatif)
    {
        $request->validate([
            'nama_alternatif' => 'required',
        ], [
            'nama_alternatif.required' => 'Nama alternatif harus diisi',
        ]);
        // $alternatif->nama_alternatif = $request->nama_alternatif;
        // $alternatif->keterangan = $request->keterangan;
        $alternatif->fill($request->all());
        $alternatif->save();

        // $updrelalt = query("UPDATE tb_rel_alternatif set kode_crips='$request->unitasal' where kode_alternatif='$request->kode_alternatif' and kode_kriteria='K05'");

        return redirect('alternatif')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alternatif $alternatif)
    {
        query("DELETE FROM tb_rel_alternatif WHERE kode_alternatif=?", [$alternatif->kode_alternatif]);
        query("DELETE FROM tb_shiftdata WHERE kode_alternatif=?", [$alternatif->kode_alternatif]);
        $alternatif->delete();
        return redirect('alternatif')->with('message', 'Data berhasil dihapus!');
    }
}
