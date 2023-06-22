<?php

namespace App\Http\Controllers;

use App\Models\Layout_Pemasukan;
use App\Http\Controllers\Controller;
use App\Models\Access_Pemasukan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class LayoutPemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layout_pemasukan = Layout_Pemasukan::first();
        $user = User::all();
        $access_pemasukan_form_1 = Access_Pemasukan::where('kategori', 'form_1');
        $access_pemasukan_form = Access_Pemasukan::where('kategori', 'form');

        return view('backend.setting.profile_app.layout_pemasukan.index', compact('layout_pemasukan', 'user', 'access_pemasukan_form_1', 'access_pemasukan_form'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Layout_Pemasukan $layout_Pemasukan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Layout_Pemasukan $layout_Pemasukan)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Layout_Pemasukan $layout_Pemasukan, $id)
    {
        $id = Crypt::decrypt($id);

        if ($request->gambar) {
            $file = $request->file('gambar');
            $nama = 'layout-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/profile_app'), $nama);
        }
        $data_layout = Layout_Pemasukan::find($id);
        $data_layout->tittle = $request->tittle;
        $data_layout->info_proses = $request->info_proses;

        if ($request->gambar) {
            $data_layout->gambar = "/img/profile_app/$nama";
        }

        $data_layout->update();
        return redirect()->back()->with('sukses', 'Tampilan Halaman Pemasukan Sudah Di Rubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Layout_Pemasukan $layout_Pemasukan)
    {
        //
    }
}
