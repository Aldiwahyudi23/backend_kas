<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\DataWarga;
use App\Models\HubunganWarga;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit_data()
    {
        $user = User::find(Auth::user()->id);
        $data_warga_ibu = DataWarga::where('jenis_kelamin', 'Perempuan')->get();
        $data_warga_ayah = DataWarga::where('jenis_kelamin', 'Laki-Laki')->get();
        $data_pribadi = DataWarga::find($user->id);

        $cek_data_ayah = HubunganWarga::where('warga_id', Auth::user()->id)->where('hubungan', 'Ayah');
        if ($cek_data_ayah->count() == 1) {
            $data_ayah = $cek_data_ayah->first();
            $ayah = DataWarga::find($data_ayah->hubungan_id);
        } else {
            $ayah = $cek_data_ayah->get();
        }
        $cek_data_ibu = HubunganWarga::where('warga_id', Auth::user()->id)->where('hubungan', 'Ibu');
        if ($cek_data_ibu->count() == 1) {
            $data_ibu = $cek_data_ibu->first();
            $ibu = DataWarga::find($data_ibu->hubungan_id);
        } else {
            $ibu = $cek_data_ibu->get();
        }

        return view('profile.edit_data', compact('data_pribadi', 'cek_data_ayah', 'cek_data_ibu', 'data_warga_ayah', 'data_warga_ibu', 'ayah', 'ibu'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
