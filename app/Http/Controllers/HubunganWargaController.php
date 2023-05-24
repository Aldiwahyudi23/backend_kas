<?php

namespace App\Http\Controllers;

use App\Models\HubunganWarga;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HubunganWargaController extends Controller
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
        $data_hubungan = new HubunganWarga();

        $data_hubungan->warga_id = $request->warga_id;
        $data_hubungan->data_warga_id = $request->data_warga_id;
        $data_hubungan->hubungan = $request->hubungan;

        $data_hubungan->save();

        return redirect()->back()->with('sukses', 'Data Hubungan Keluarga Atos Masuk');
    }

    /**
     * Display the specified resource.
     */
    public function show(HubunganWarga $hubunganWarga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HubunganWarga $hubunganWarga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HubunganWarga $hubunganWarga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HubunganWarga $hubunganWarga)
    {
        //
    }
}
