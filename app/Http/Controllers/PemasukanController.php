<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Http\Controllers\Controller;
use App\Models\Access_Pemasukan;
use App\Models\AccessProgram;
use App\Models\DataWarga;
use App\Models\KategoriAnggaranProgram;
use App\Models\Pengajuan;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'data_warga' => 'required',
            'kategori_id' => 'required',
            'pembayaran' => 'required',
            'jumlah' => 'required|numeric',
            'keterangan' => 'required',
        ], [
            'data_warga.required' => 'data_warga kedah di pilih',
            'kategori_id.required' => 'Kategori kedah di pilih',
            'pembayaran.required' => 'Pembayaran kedah di pilih',
            'jumlah.required' => 'Nominal kedah di isi',
            'jumlah.numeric' => 'Nominal teu kengeng kangge titik',
            'keterangan.required' => 'keterangan kedah di isi',
        ]);

        if ($request->foto) {
            $file = $request->file('foto');
            $nama = 'bukti-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/bukti'), $nama);
        }

        $data_pemasukan = new Pemasukan();
        $data_pemasukan->data_warga_id = $request->data_warga;
        $data_pemasukan->pengaju_id = $request->pengaju_id;
        $data_pemasukan->jumlah = $request->jumlah;
        $data_pemasukan->pembayaran = $request->pembayaran;
        $data_pemasukan->kategori_id = $request->kategori_id;
        $data_pemasukan->keterangan = $request->keterangan;
        $data_pemasukan->tanggal = $request->tanggal;
        $data_pemasukan->pengurus_id = Auth::user()->data_warga_id;

        if ($request->foto) {
            $data_pemasukan->foto          = "/img/bukti/$nama";
        }
        if ($request->foto1) {
            $data_pemasukan->foto          = $request->foto1;
        }

        $data_pemasukan->save();
        // jika ada pengajuan ID hapus
        if ($request->pengajuan_id) {
            $pengajuan = Pengajuan::find($request->pengajuan_id);
            $pengajuan->delete();
            return redirect('/pengajuans/kas')->with('sukses', 'Wihhhh mantappp hatur nuhun atos ngaKONFIRMASI pengajuan pemabyaran KAS keluarga. Lancar selalu');
        } else {
            return redirect()->back()->with('sukses', 'Wihhhh mantappp hatur nuhun atos masukeun data pembayaran KAS keluarga. Lancar selalu ATOS LEBET');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemasukan $pemasukan)
    {
        //
    }

    public function pemasukan_index()
    {
        $access_pemasukan = Access_Pemasukan::where('user_id', Auth::user()->id)->where('role_id', Auth::user()->role_id)->where('Kategori', "form");
        $access_pemasukan_form_1 = Access_Pemasukan::where('user_id', Auth::user()->id)->where('role_id', Auth::user()->role_id)->where('Kategori', "form_1");
        $data_warga_program = AccessProgram::where('program_id', 1);
        $program = Program::find(1);
        $data_warga = DataWarga::all();
        $data_kategori = KategoriAnggaranProgram::all();
        $data_pemasukan_kas_user = Pemasukan::orderByRaw('created_at DESC')->where('data_warga_id', Auth::user()->data_warga_id)->get();
        $data_pemasukan_semua = Pemasukan::orderByRaw('created_at DESC')->where('kategori_id', '1')->get();
        $data_pemasukan_setor_tunai = Pemasukan::orderByRaw('created_at DESC')->where('kategori_id', '3')->get();

        return view('frontend.pemasukan.index', compact(
            'access_pemasukan',
            'access_pemasukan_form_1',
            'data_warga_program',
            'data_warga',
            'program',
            'data_pemasukan_semua',
            'data_kategori',
            'data_pemasukan_kas_user'
        ));
    }
}
