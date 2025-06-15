<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konten;
use App\Models\Event;
use App\Models\Akun;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{

    public function index(Request $request)
    {
        $query = Konten::with('akun');
        $totalEvents = Event::count();
        $total = Konten::count();

        if ($request->has('kategori') && $request->kategori != 'semua') {
            $query->where('kategori', $request->kategori);
        }

        if ($request->has('asal') && $request->asal != 'semua') {
            $query->where('asal', $request->asal);
        }

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('judul', 'like', '%'.$request->search.'%')
                ->orWhere('isi', 'like', '%'.$request->search.'%');
            });
        }

        $contents = $query->paginate(10);

        return view('admin.konten.index', compact('contents', 'total','totalEvents' ));
    }


    public function create()
    {
        $total = Konten::count();

        return view('admin.konten.create', compact('total'));
    }

    public function edit($id)
    {
        $konten = Konten::with('akun.role')->findOrFail($id);

        $role = $konten->akun->role->nama_role ?? null;

        $isAdmin = $role === 'admin';
        $isUser = $role === 'user';

        return response()->json([
            'konten' => $konten,
            'isAdmin' => $isAdmin,
            'isUser' => $isUser
        ]);
    }


    public function update(Request $request, $id)
    {
        $konten = Konten::findOrFail($id);
        $user = auth()->user();

        $isAdmin = auth()->user()->role->nama_role === 'admin';

        if ($isAdmin || $konten->akun_id == $user->id) {
            if ($isAdmin) {
                $konten->update($request->only(['judul', 'isi', 'kategori', 'asal', 'status']));
            } else {
                $konten->update($request->only(['status']));
            }
        }

        return redirect()->back()->with('success', 'Konten berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $konten = Konten::findOrFail($id);
        $konten->delete();

        return redirect()->back()->with('success', 'Konten berhasil dihapus.');
    }

    public function read()
    {
        return view('admin.konten.index');
    }
    public function profile()
    {
        $total = Konten::count();
        $admin = Auth::user();
        $totalEvents = Event::count();
        return view('admin.profile.index', compact('admin', 'total', 'totalEvents'));
    }

    public function editProfile()
    {
        $admin = Auth::user();
        return view('admin.profile.edit', compact('admin'));
    }
    public function updateProfile(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:akun,email,' . Auth::id(),
        'nomor_hp' => 'required|string|max:15|unique:akun,nomor_hp,' . Auth::id(),
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $admin = Akun::findOrFail(Auth::id());
    $admin->username = $request->name;
    $admin->email = $request->email;
    $admin->nomor_hp = $request->nomor_hp;

    if ($request->password) {
        $admin->password = bcrypt($request->password);
    }

    $admin->save();

    return redirect()->route('admin.profile')->with('success', 'Profile berhasil diperbarui.');
}
}
