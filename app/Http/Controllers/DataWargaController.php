<?php

namespace App\Http\Controllers;

use App\Models\DataWarga;
use App\Http\Controllers\Controller;
use App\Models\FotoUser;
use App\Models\HubunganWarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DataWargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_warga = DataWarga::all();

        return view('backend.master_data.data_warga.index', compact('data_warga'));
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
        $request->validate(
            [
                'nama' => 'required',
                'jenis_kelamin' => 'required',
                'tanggal_lahir' => 'required',
                'tempat_lahir' => 'required',
                'no_hp' => 'required',
                'agama' => 'required',
                'status_pernikahan' => 'required',
                'status' => 'required',

                'provinsi' => 'required',
                'kota' => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',
                'kampung' => 'required',
                'rt' => 'required',
                'rw' => 'required',

            ],
            [
                'nama.required' => 'Nama Harus Di Isin',
                'jenis_kelamin.required' => 'Jenis Kelamin Harus Di Isin',
                'tanggal_lahir.required' => 'Tanggal lahir Harus Di Isin',
                'tempat_lahir.required' => 'Tempat Lahir Harus Di Isin',
                'no_hp.required' => 'No HP Harus Di Isin',
                'agama.required' => 'Agama Harus Di Isin',
                'status_pernikahan.required' => 'Status Pernikahan Harus Di Isin',
                'status.required' => 'Status Harus Di Isin',

                'provinsi.required' => 'provinsi Harus Di Isin',
                'kota.required' => 'kota Harus Di Isin',
                'kecamatan.required' => 'kecamatan Harus Di Isin',
                'kelurahan.required' => 'kelurahan Harus Di Isin',
                'kampung.required' => 'kampung Harus Di Isin',
                'rt.required' => 'rt Harus Di Isin',
                'rw.required' => 'rw Harus Di Isin',
            ]
        );

        if ($request->foto) {
            $file = $request->file('foto');
            $nama = 'profile-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/warga'), $nama);
        } else {
            if ($request->jenis_kelamin == "Laki-Laki") {
                $foto_template = "/img/template/52471919042020_male.jpg";
            } else {
                $foto_template = "/img/template/52471919042020_female.jpg";
            }
        }



        $data_warga = new DataWarga();
        $data_warga->nama = $request->nama;
        $data_warga->jenis_kelamin = $request->jenis_kelamin;
        $data_warga->tempat_lahir = $request->tempat_lahir;
        $data_warga->tanggal_lahir = $request->tanggal_lahir;
        $data_warga->alamat =  $request->kampung . ", RT/RW " . $request->rt . "/" . $request->rw . ", Des. " . $request->kelurahan . ", Kec. " . $request->kecamatan . ", " . $request->kota . ", " . $request->provinsi;
        $data_warga->no_hp = $request->no_hp;
        $data_warga->agama = $request->agama;
        $data_warga->status_pernikahan = $request->status_pernikahan;
        $data_warga->status = $request->status;



        $data_warga->save();


        $foto_user = new FotoUser();
        $foto_user->data_warga_id = $data_warga->id;
        $foto_user->is_active = 1;
        if ($request->foto) {
            $foto_user->foto = "/img/warga/$nama";
        } else {
            $foto_user->foto = $foto_template;
        }


        $foto_user->save();

        // untuk menyimpan data ke hubungan
        if ($request->jenis_kelamin == "Laki-Laki") {
            $data_hubungan = "Ayah";
        }
        if ($request->jenis_kelamin == "Perempuan") {
            $data_hubungan = "Ibu";
        }

        if ($request->pribadi) {
            $data_hubungan_keluarga = new HubunganWarga();

            $data_hubungan_keluarga->warga_id = $request->user;
            $data_hubungan_keluarga->data_warga_id = $data_warga->id;
            $data_hubungan_keluarga->hubungan = $data_hubungan;

            $data_hubungan_keluarga->save();
        }

        return redirect()->back()->with('sukses', 'Wihhhh mantapppp bener');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);

        $data_warga = DataWarga::find($id);
        $cek_data_hubungan = HubunganWarga::where('warga_id', $id)->where('hubungan', 'Ayah')->first(); //mengambil data dari table hubungan keluarga sesuai dengan warga id yang di ambil dari data

        return view('backend.master_data.data_warga.show', compact('data_warga', 'cek_data_hubungan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);

        $data_warga = DataWarga::find($id);

        return view('backend.master_data.data_warga.edit', compact('data_warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $request->validate(
            [
                'nama' => 'required',

            ],
            [
                'nama.required' => 'Nama Harus Di Isin',
            ]
        );

        if ($request->foto) {
            $file = $request->file('foto');
            $nama = 'profile-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/warga'), $nama);
        }

        $data_warga = DataWarga::find($id);
        $data_warga->nama = $request->nama;
        $data_warga->jenis_kelamin = $request->jenis_kelamin;
        $data_warga->tempat_lahir = $request->tempat_lahir;
        $data_warga->tanggal_lahir = $request->tanggal_lahir;
        $data_warga->no_hp = $request->no_hp;
        $data_warga->agama = $request->agama;
        $data_warga->status_pernikahan = $request->status_pernikahan;
        $data_warga->status = $request->status;
        if ($request->kelurahan) {
            $data_warga->alamat =  $request->kampung . ", RT/RW " . $request->rt . "/" . $request->rw . ", Des. " . $request->kelurahan . ", Kec. " . $request->kecamatan . ", " . $request->kota . ", " . $request->provinsi;
        }

        if ($request->foto) {
            $data_warga->foto = "/img/warga/$nama";
        }

        $data_warga->update();

        return redirect()->back()->with('infoes', 'Wihhhh mantapppp bener, Data atos ka gentos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
