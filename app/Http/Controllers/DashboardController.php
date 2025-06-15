<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Konten;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = $this->getBasicStats();
        $recentActivities = $this->getRecentActivities();
        $totalEvents = Event::count();
        $total = Konten::count();


        return view('admin.dashboard', compact(
            'stats',
            'recentActivities',
             'total',
             'totalEvents'
        ));
    }

    private function getBasicStats()
    {
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();

        return [
            'total_users' => Akun::count(),
            'new_users_today' => Akun::whereDate('created_at', $today)->count(),
            'total_content' => Konten::count(),
            'new_content_today' => Konten::whereDate('created_at', $today)->count(),
            'total_events' => Event::count(),
            'new_events_this_month' => Event::where('created_at', '>=', $thisMonth)->count(),
            'total_views' => Konten::sum('views_count') + Event::sum('views_count'),
            'approved_content' => Konten::where('status', 'approved')->count(),
            'pending_content' => Konten::where('status', 'pending')->count(),
            'rejected_content' => Konten::where('status', 'rejected')->count(),
        ];
    }

    private function getRecentActivities()
    {
        $activities = collect();

        $recentUsers = Akun::latest()->limit(3)->get();
        foreach ($recentUsers as $user) {
            $activities->push([
                'type' => 'new_user',
                'message' => 'Pengguna baru mendaftar',
                'user' => $user->username,
                'time' => $user->created_at
            ]);
        }

        $recentContent = Konten::latest()->limit(3)->get();
        foreach ($recentContent as $content) {
            $activities->push([
                'type' => 'new_content',
                'message' => 'Konten baru: ' . $content->judul,
                'user' => $content->akun->username ?? 'Unknown',
                'time' => $content->created_at
            ]);
        }

        $recentEvents = Event::latest()->limit(2)->get();
        foreach ($recentEvents as $event) {
            $activities->push([
                'type' => 'new_content',
                'message' => 'Event baru: ' . $event->judul,
                'user' => $event->akun->username ?? 'Unknown',
                'time' => $event->created_at
            ]);
        }

        $recentApprovals = Konten::where('status', 'approved')
            ->latest('updated_at')
            ->limit(2)
            ->get();

        foreach ($recentApprovals as $approval) {
            $activities->push([
                'type' => 'approval',
                'message' => 'Konten disetujui: ' . $approval->judul,
                'user' => 'Admin',
                'time' => $approval->updated_at
            ]);
        }

        return $activities->sortByDesc('time')->take(8)->values();
    }

}
