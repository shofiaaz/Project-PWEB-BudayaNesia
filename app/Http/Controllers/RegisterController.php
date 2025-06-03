<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomor_hp' => 'required|string|min:10|unique:akun,nomor_hp|regex:/^[0-9]+$/',
            'password' => 'required|min:8',
            'confirmPassword' => 'required|same:password',
            'username' => 'required|string|unique:akun,username',
            'email' => 'required|string|email|unique:akun,email',
        ], [
            'nomor_hp.required' => 'Nomor HP wajib diisi.',
            'nomor_hp.unique' => 'Nomor HP sudah terdaftar.',
            'nomor_hp.min' => 'Nomor HP minimal 10 digit.',
            'nomor_hp.regex' => 'Format Nomor HP tidak valid (hanya angka).',

            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',

            'confirmPassword.required' => 'Konfirmasi password wajib diisi.',
            'confirmPassword.same' => 'Konfirmasi password tidak cocok dengan password.',

            'email.required' => 'Email wajib diisi.',
            'email.string' => 'Email harus berupa teks.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $idUser = \App\Models\Role::where('nama_role', 'user')->value('id');

            $user = new Akun();
            $user->nomor_hp = $request->nomor_hp;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->username = $request->username;
            $user->id_role = $idUser;

            if ($user->save()) {
                return redirect()->back()->with('success_swal', 'Selamat Akun berhasil dibuat.');
            } else {
                return redirect()->back()->with('error');
            }

        } catch (\Exception $e) {
            \Log::error('Registrasi Gagal: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat registrasi. Silakan coba lagi.')->withInput();
        }
    }
}
