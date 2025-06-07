<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::where('status', 'approved');

        // Filter
        if ($request->has('kategori') && $request->kategori != 'semua') {
            $query->where('kategori', $request->kategori);
        }



        // Search
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('judul', 'like', '%'.$request->search.'%')
                  ->orWhere('isi', 'like', '%'.$request->search.'%');
            });
        }

        $contents = $query->paginate(6);
        $tempatList = Event::where('status', 'approved')->distinct()->pluck('tempat');


        return view('user.event ', compact('contents', 'tempatList'));
    }


        public function create()
    {
        return view('user.event.create');
    }


        public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'kategori' => 'required|in:tarian,musik,kuliner,upacara,kerajinan',
            'tempat' => 'required',
            'isi' => 'required',
            'jadwal' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('event-thumbnails', 'public');
        }

        Event::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'kategori' => $request->kategori,
            'tempat' => $request->tempat,
            'jadwal' =>$request->jadwal,
            'thumbnail' => $thumbnailPath,
            'akun_id' => Auth::id(),
            'status' => 'pending'
        ]);

        Alert::success('Sukses', 'Konten budaya berhasil diajukan!');
        return redirect()->route('event.histori');
    }

        public function show($id)
    {
        $event = Event::with('akun')->findOrFail($id);

        // Tambah 1 ke views_count
        $event->increment('views_count');


        return view('user.event.show', compact('event'));
    }

    public function histori()
    {
        $events = Event::where('akun_id', Auth::id())
                            ->latest()
                            ->paginate(10);

        return view('user.event.histori', compact('events'));
    }
        public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->akun_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Tidak diizinkan menghapus $event ini.');
        }

        if ($event->status !== 'pending') {
            return redirect()->back()->with('error', '$event hanya bisa dihapus saat masih pending.');
        }

        if ($event->thumbnail) {
            Storage::delete('public/' . $event->thumbnail);
        }

        $event->delete();

        return redirect()->back()->with('success', 'Event berhasil dihapus.');
    }

    public function indexAdmin()
    {
        $events = Event::all();
        return view('admin.event.index', compact('events'));
    }

    public function createAdmin()
    {
        return view('admin.event.create');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'akun_id' => 'required|exists:akun,id',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'judul' => 'required|string|max:255',
            'jadwal' => 'required|date',
            'tempat' => 'required|string|max:255',
            'isi' => 'required|string',
            'kategori' => 'required|in:tarian,musik,kuliner,upacara,kerajinan',
            'status' => 'required|in:rejected,pending,approved',
            'views_count' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/events', $filename);
            $data['thumbnail'] = 'events/' . $filename;
        }

        Event::create($data);
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dibuat.');
    }

    public function editAdmin(Event $event)
    {
        return response()->json($event);
    }

    public function updateAdmin(Request $request, Event $event)
    {
        $request->validate([
            'akun_id' => 'required|exists:akun,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'judul' => 'required|string|max:255',
            'jadwal' => 'required|date',
            'tempat' => 'required|string|max:255',
            'isi' => 'required|string',
            'kategori' => 'required|in:tarian,musik,kuliner,upacara,kerajinan',
            'status' => 'required|in:rejected,pending,approved',
            'views_count' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($event->thumbnail) {
                Storage::delete('public/' . $event->thumbnail);
            }

            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/events', $filename);
            $data['thumbnail'] = 'events/' . $filename;
        }

        $event->update($data);
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui.');
    }

    public function destroyAdmin(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus.');
    }

}
