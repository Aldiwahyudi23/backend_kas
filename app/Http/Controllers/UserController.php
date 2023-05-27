<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
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
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'role_id' => 'required',
                'data_warga_id' => 'required',
            ],
            [
                'nama.required' => 'Nama Kedah di isin',
                'email.required' => 'email Kedah di isin',
                'password.required' => 'password Kedah di isin',
                'role_id.required' => 'Role Kedah di isin',
                'data_warga_id.required' => 'Data Warga Kedah di isin',
            ]
        );

        $data_user = new User();
        $data_user->name = $request->name;
        $data_user->email = $request->email;
        $data_user->password = $request->password;
        $data_user->role_id = $request->role_id;
        $data_user->data_warga_id = $request->data_warga_id;

        $data_user->save();

        return redirect()->back()->with('sukse', 'Wihhhh mantap bos account atos jadi, gaskeunnn');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
