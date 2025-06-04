<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konten;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KontenController extends Controller
{
    public function index(Request $request)
    {
        $query = Konten::where('status', 'approved');

        // Filter
        if ($request->has('kategori') && $request->kategori != 'semua') {
            $query->where('kategori', $request->kategori);
        }

        // Filter
        if ($request->has('asal') && $request->asal != 'semua') {
            $query->where('asal', $request->asal);
        }

        // Search
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('judul', 'like', '%'.$request->search.'%')
                  ->orWhere('isi', 'like', '%'.$request->search.'%');
            });
        }

        $contents = $query->paginate(6);
        $asalList = Konten::where('status', 'approved')->distinct()->pluck('asal');


        return view('user.konten', compact('contents', 'asalList'));
    }

    public function histori()
    {
        $contents = Konten::where('akun_id', Auth::id())
                            ->latest()
                            ->paginate(10);

        return view('user.konten.histori', compact('contents'));
    }

    public function create()
    {
        return view('user.konten.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'kategori' => 'required|in:tarian,musik,kuliner,upacara,kerajinan',
            'asal' => 'required',
            'isi' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('konten-thumbnails', 'public');
        }

        Konten::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'kategori' => $request->kategori,
            'asal' => $request->asal,
            'thumbnail' => $thumbnailPath,
            'akun_id' => Auth::id(),
            'status' => 'pending'
        ]);

        Alert::success('Sukses', 'Konten budaya berhasil diajukan!');
        return redirect()->route('konten.histori');
    }

    public function show($id)
    {
        $content = Konten::with('akun')->findOrFail($id);

        // Tambah 1 ke views_count
        $content->increment('views_count');


        return view('user.konten.show', compact('content'));
    }

    public function destroy($id)
    {
        $konten = Konten::findOrFail($id);

        if ($konten->akun_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Tidak diizinkan menghapus konten ini.');
        }

        if ($konten->status !== 'pending') {
            return redirect()->back()->with('error', 'Konten hanya bisa dihapus saat masih pending.');
        }

        if ($konten->thumbnail) {
            Storage::delete('public/' . $konten->thumbnail);
        }

        $konten->delete();

        return redirect()->back()->with('success', 'Konten berhasil dihapus.');
    }



}
