<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Rel_Alternatif;
use App\Models\Tindakan;
use Illuminate\Http\Request;

class DaftartindakanController extends Controller
{
    // public function cetak()
    // {
    //     $data['title'] = 'Laporan Data Nilai Alternatif';
    //     $data['rows'] = Alternatif::with(['nilais'])->orderBy('kode_alternatif')->get();
    //     $data['kriterias'] = Kriteria::all();
    //     return view('rel_alternatif.cetak', $data);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Daftar Tindakan';
        $data['limit'] = 10;
        $data['rows'] = Tindakan::
            select('tb_tindakan.*','tb_alternatif.nama_alternatif')
            ->where('tb_alternatif.nama_alternatif', 'like', '%' . $data['q'] . '%')
            ->leftJoin('tb_alternatif','tb_tindakan.kode_alternatif','tb_alternatif.kode_alternatif')
            ->orderBy('tb_tindakan.kode_alternatif')
            ->paginate($data['limit'])->withQueryString();
        // $data['rel_alternatif'] = get_rel_alternatif();
        // $data['crips'] = get_crips();
        // $data['kriterias'] = get_kriteria();

        // dd($data[]);
        return view('daftartindakan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Buat Tindakan';
        $data['namapasien'] = get_results("SELECT kode_alternatif,nama_alternatif,nik FROM tb_alternatif ");
        return view('daftartindakan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Tindakan($request->all());
        $data->save();

        return redirect('daftartindakan')->with('message', 'Data berhasil ditambah!');

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
    // public function edit(string $alternatif)
    // {
    //     $data['row'] = Alternatif::findOrFail($alternatif);
    //     $data['rows'] = Rel_Alternatif::where('kode_alternatif', $alternatif)->first();
    //     $data['nilais'] = get_results("SELECT * FROM tb_rel_alternatif r INNER JOIN tb_kriteria k ON k.kode_kriteria=r.kode_kriteria WHERE kode_alternatif='$alternatif'");
    //     $data['title'] = 'Ubah Tindakan';
    //     return view('daftartindakan.edit', $data);
    // }

    public function edit($id)
    {
        $data['row'] = Tindakan::select('tb_tindakan.*','tb_alternatif.nama_alternatif','tb_alternatif.nik')
        ->leftJoin('tb_alternatif','tb_tindakan.kode_alternatif','tb_alternatif.kode_alternatif')
        ->where('id',$id)
        ->first();
        // $data['rows'] = Rel_Alternatif::where('kode_alternatif', $alternatif)->first();
        // $data['nilais'] = get_results("SELECT * FROM tb_rel_alternatif r INNER JOIN tb_kriteria k ON k.kode_kriteria=r.kode_kriteria WHERE kode_alternatif='$alternatif'");
        $data['title'] = 'Ubah Tindakan';
        return view('daftartindakan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rel_Alternatif  $rel_Alternatif
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request,$id)
    // {
    //     // $request->validate([
    //     //     'nilai.*' => 'required',
    //     // ], [
    //     //     'nilai.*.required' => 'Nilai :attribute harus diisi',
    //     // ]);
    //     // $alternatif = Rel_Alternatif::where('kode_alternatif',$request->kode_alternatif)->first();
    //     // $alternatif->tgl_pengajuan = $request->tgl_pengajuan;
    //     // $alternatif->jam_pengajuan = $request->jam_pengajuan;
    //     // $alternatif->jenis_tindakan = $request->jenis_tindakan;
    //     // $alternatif->save();
    //     // foreach ($request->nilai as $key => $val) {
    //     //     $rel_alternatif = Rel_Alternatif::find($key);
    //     //     $rel_alternatif->kode_crips = $val;
    //     //     $rel_alternatif->save();
    //     // }
    //     $tindakan = Tindakan::where('id',$id)->first();
    //     return $request;
    //     $tindakan->update($request->all());
    //     // $tindakan->save();
    //     return redirect('daftartindakan')->with('message', 'Data berhasil diubah!');
    // }

    public function update(Request $request, $id)
    {
        try {
            
            $requestData = $request->all();

            $data = Tindakan::findOrFail($id);
            $data->update($requestData);
            // $data->shift = 3;
            // $data->save();
            // return $requestData;
            // $data->fill($request->all());
            // $data->save();

            return redirect('daftartindakan')->with('message', 'Data berhasil diubah!');

            // return response()->json(["status" => "success", "message" => $data]);

        } catch (\Exception $e) {

            return response()->json(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rel_Alternatif  $rel_Alternatif
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tindakan = Tindakan::where('id',$id)->first();
        $tindakan->delete();
        return redirect('daftartindakan')->with('message', 'Data berhasil dihapus!');
    }

    public function updstatus(Request $request, $kode) {
        $getdata = Rel_Alternatif::where('kode_alternatif',$kode)
        ->get();
        foreach($getdata as $data) {
            $data->status = $request->status;
            $data->save();
        }

        return $getdata;

    }
}
