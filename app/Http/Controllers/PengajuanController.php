<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Http\Controllers\Controller;
use App\Models\AccessProgram;
use App\Models\DataWarga;
use App\Models\KategoriAnggaranProgram;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_warga_program = AccessProgram::all();
        $data_warga = DataWarga::all();

        return view('backend.transaksi.pengajuan.index', compact('data_warga_program',  'data_warga'));
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
            'jumlah' => 'required',
            'pembayaran' => 'required',
            'keterangan' => 'required',
        ], [
            'jumlah.required' => "Nominal kedah di isi, kade tong ngange titik atau koma",
            'pembayaran.required' => "Metode Pembayaran kedah di pilih, Transfer atau Uang tunai",
            'keterangan.required' => "Keterangan kedah di isi secara detail",
        ]);

        if ($request->foto) {
            $file = $request->file('foto');
            $nama = 'bukti-' . date('Y-m-dhis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/bukti'), $nama);
        }

        $tanggal = Carbon::now();
        $data_ketegori = KategoriAnggaranProgram::find($request->kategori_id);

        $data_pengajuan = new Pengajuan();

        $data_pengajuan->kode = $data_ketegori->kode . date('dmyhis');
        $data_pengajuan->jumlah = $request->jumlah;
        $data_pengajuan->pembayaran = $request->pembayaran;
        $data_pengajuan->keterangan = $request->keterangan;
        $data_pengajuan->data_warga_id = $request->data_warga;
        $data_pengajuan->pengaju_id = $request->pengaju_id;
        $data_pengajuan->kategori_id = $request->kategori_id;
        $data_pengajuan->tanggal = $tanggal;
        $data_pengajuan->status = "Proses";

        if ($request->pengeluaran_id) {
            $data_pengajuan->pengeluaran_id = $request->pengeluaran_id;
        }
        if ($request->sekertaris) {
            $data_pengajuan->sekertaris = $request->sekertaris;
        }
        if ($request->bendahara) {
            $data_pengajuan->bendahara = $request->bendahara;
        }
        if ($request->foto) {
            $data_pengajuan->foto = "/img/bukti/$nama";
        }

        $data_pengajuan->save();

        return redirect()->back()->with('sukses', 'Wihhhhh Alhamdulilahhh pengajuan nuju di proses heula nya, antosan sakedap. Hatur Nuhun Pisan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);

        $data_pengajuan = Pengajuan::Find($id);
        return view('backend.transaksi.pengajuan.show', compact('data_pengajuan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengajuan $pengajuan)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $data_pengajuan = Pengajuan::find($id);

        $data_pengajuan->delete();

        return redirect()->back()->with('kuning', 'Data Parantos di hapus tina disimpen dina sampah )');
    }
    public function trash()
    {
        $data_pengajuan = Pengajuan::orderByRaw('created_at DESC')->onlyTrashed()->get();

        return view('pengajuan.trash', compact('data_pengajuan'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $data_pengajuan = Pengajuan::withTrashed()->findorfail($id);
        $data_pengajuan->restore();
        return redirect()->back()->with('infoes', 'Data pengajuan atos di kembalikeun deui tina sampah');
    }

    public function kill($id)
    {
        $id = Crypt::decrypt($id);
        $data_pengajuan = Pengajuan::withTrashed()->findorfail($id);

        $data_pengajuan->forceDelete();
        return redirect()->back()->with('kuning', 'Data pengajuan parantos di hapus dina sampah');
    }

    // Pengajuan ==================================================================================================
    public function index_pemasukan()
    {
        $data_pengajuan = Pengajuan::orderByRaw('created_at DESC')->where('kategori_id', 1)->get();

        return view('frontend.pengajuan.index', compact('data_pengajuan'));
    }
    // ------------------------------------------------------------------------------------------------------------
    // Pengluaran==================================================================================================
    public function index_tabungan()
    {
        $data_pengajuan = Pengajuan::orderByRaw('created_at DESC')->where('kategori_id', 2)->get();

        return view('frontend.pengajuan.index', compact('data_pengajuan'));
    }
    // -----------------------------------------------------------------------------------------------------------
    // Pengluaran==================================================================================================
    public function tarik_tabungan()
    {
        $data_pengajuan = Pengajuan::orderByRaw('created_at DESC')->where('kategori_id', 5)->get();

        return view('frontend.pengajuan.index', compact('data_pengajuan'));
    }
    // -----------------------------------------------------------------------------------------------------------
    // Pinjaman ==================================================================================================
    public function index_pinjam()
    {
        $data_pengajuan = Pengajuan::orderByRaw('created_at DESC')->where('kategori_id', 4)->get();

        return view('frontend.pengajuan.index', compact('data_pengajuan'));
    }
    // ------------------------------------------------------------------------------------------------------------
    // Bayar Pinjaman =============================================================================================
    public function index_bayar_pinjam()
    {
        $data_pengajuan = Pengajuan::orderByRaw('created_at DESC')->where('kategori_id', 6)->get();

        return view('frontend.pengajuan.index', compact('data_pengajuan'));
    }
    // ------------------------------------------------------------------------------------------------------------

    public function pengajuan_user($id)
    {
        $id = Crypt::decrypt($id);

        $data_pengajuan = Pengajuan::Find($id);
        return view('frontend.pengajuan.show', compact('data_pengajuan'));
    }
}
