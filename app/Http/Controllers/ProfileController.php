<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{

    public function show()
    {
        $user = Auth::user();

        return view('user.profile.show', compact('user'));
    }


    public function edit()
    {
        $user = Auth::user();
        return view('user.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => [
                'required',
                'string',
                'max:255',
                'alpha_num',
                Rule::unique('akun')->ignore($user->id),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('akun')->ignore($user->id),
            ],
            'nomor_hp' => [
                'required',
                'string',
                'max:15',
                'regex:/^(\+62|62|0)[0-9]{9,13}$/',
                Rule::unique('akun')->ignore($user->id),
            ],

        ], [
            'username.required' => 'Username wajib diisi.',
            'username.alpha_num' => 'Username hanya boleh berisi huruf dan angka.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'nomor_hp.required' => 'Nomor HP wajib diisi.',
            'nomor_hp.regex' => 'Format nomor HP tidak valid.',
            'nomor_hp.unique' => 'Nomor HP sudah digunakan.',

        ]);


        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'nomor_hp' => $request->nomor_hp,
        ]);

        return redirect()->route('profile.show')
                        ->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.show')
                        ->with('success', 'Password berhasil diubah!');
    }

}
