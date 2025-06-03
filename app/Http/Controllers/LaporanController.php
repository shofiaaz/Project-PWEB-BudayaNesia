<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;
use App\Models\Konten;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        // Ambil user dengan kontribusi konten dan event yang sudah approved
        $akunWithContributions = Akun::select('akun.*')
            ->leftJoin('konten', function($join) {
                $join->on('akun.id', '=', 'konten.akun_id')
                    ->where('konten.status', '=', 'approved');
            })
            ->leftJoin('events', function($join) {
                $join->on('akun.id', '=', 'events.akun_id')
                    ->where('events.status', '=', 'approved');
            })
            ->leftJoin('badge_levels', 'akun.id', '=', 'badge_levels.akun_id')
            ->selectRaw('akun.*,
                        COUNT(DISTINCT konten.id) as total_content,
                        COUNT(DISTINCT events.id) as total_event,
                        (COUNT(DISTINCT konten.id) + COUNT(DISTINCT events.id)) as total_contribution,
                        COALESCE(badge_levels.poin, 0) as poin,
                        COALESCE(badge_levels.status, "Abdi") as badge_status')
            ->groupBy('akun.id', 'akun.username', 'akun.nomor_hp', 'akun.password','akun.id_role','akun.email', 'akun.created_at', 'akun.updated_at', 'badge_levels.poin', 'badge_levels.status')
            ->having('total_contribution', '>', 0)
            ->orderByDesc('total_contribution')
            ->get();

        // Ambil semua konten yang sudah approved, urutkan berdasarkan views terbanyak
        $approvedkonten = Konten::where('status', 'approved')
            ->orderByDesc('views_count')
            ->with('akun') // Assuming ada relasi dengan user
            ->get();


        // Ambil semua event yang sudah approved, urutkan berdasarkan views terbanyak
        $approvedEvents = Event::where('status', 'approved')
            ->orderByDesc('views_count')
            ->with('akun') // Assuming ada relasi dengan user
            ->get();

        // Statistik ringkasan
        $totalakun = $akunWithContributions->count();
        $totalkonten = $approvedkonten->count();
        $totalEvents = $approvedEvents->count();
        $totalViews = $approvedkonten->sum('views_count') + $approvedEvents->sum('views_count');

        return view('admin.laporan.index', compact(
            'akunWithContributions',
            'approvedkonten',
            'approvedEvents',
            'totalakun',
            'totalkonten',
            'totalEvents',
            'totalViews'
        ));
    }
}
