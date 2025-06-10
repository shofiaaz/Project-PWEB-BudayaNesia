<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Foundation\Auth\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use App\Models\Konten;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function home() {
        $popularContents = Konten::where('status', 'approved')
                                ->orderBy('views_count', 'desc')
                                ->take(3)
                                ->get();

        $upcomingEvents = Event::where('status', 'approved')
                            ->where('jadwal', '>=', now())
                            ->orderBy('views_count', 'desc')
                            ->orderBy('jadwal', 'asc')
                            ->take(2)
                            ->get();

        return view('user.index', compact('popularContents', 'upcomingEvents'));
    }

    public function dashboard()
    {
        // Get visitor analytics data (last 30 days)
        $today = now();
        $startDate = now()->subDays(29);
        $dateRange = [];
        $visitorData = [];
        $pageViewData = [];

        // Generate date range and placeholder data
        for ($i = 0; $i < 30; $i++) {
            $date = $startDate->copy()->addDays($i);
            $dateRange[] = $date->format('d M');

            // In a real app, you would fetch this from your analytics database
            $visitorData[] = rand(50, 500);
            $pageViewData[] = rand(100, 1000);
        }

        // Get device statistics
        $deviceStats = [
            'desktop' => 58,
            'mobile' => 34,
            'tablet' => 8
        ];

        // Get browser statistics
        $browserStats = [
            'Chrome' => 64,
            'Safari' => 19,
            'Firefox' => 10,
            'Edge' => 5,
            'Others' => 2
        ];

        // Get traffic sources
        $trafficSources = [
            'Direct' => 40,
            'Organic Search' => 25,
            'Social Media' => 20,
            'Referral' => 10,
            'Email' => 5
        ];

        // Get user demographics
        $userDemographics = [
            'Indonesia' => 65,
            'Malaysia' => 12,
            'Singapore' => 8,
            'United States' => 6,
            'Others' => 9
        ];

        // Get popular content
        $popularContent = Konten::orderBy('views_count', 'desc')
            ->take(5)
            ->get(['id', 'judul', 'views_count', 'created_at', 'kategori']);

        // Get recent activities
        $recentActivities = collect([
            [
                'type' => 'new_user',
                'message' => 'Pengguna baru mendaftar',
                'user' => 'johndoe',
                'time' => now()->subHours(2),
            ],
            [
                'type' => 'new_content',
                'message' => 'Konten baru ditambahkan',
                'user' => 'janedoe',
                'time' => now()->subHours(5),
            ],
            [
                'type' => 'comment',
                'message' => 'Komentar baru pada konten',
                'user' => 'admin123',
                'time' => now()->subHours(8),
            ],
            [
                'type' => 'login',
                'message' => 'Login berhasil',
                'user' => 'superadmin',
                'time' => now()->subHours(12),
            ],
            [
                'type' => 'approval',
                'message' => 'Konten disetujui',
                'user' => 'moderator',
                'time' => now()->subHours(24),
            ],
        ]);

        // Get system status
        $systemStatus = [
            'server_load' => rand(10, 60),
            'memory_usage' => rand(30, 80),
            'disk_usage' => rand(40, 90),
            'uptime' => '99.9%',
            'last_backup' => now()->subDays(1)->format('d M Y H:i'),
        ];

        // Get notifications
        $notifications = collect([
            [
                'type' => 'warning',
                'message' => 'Disk space running low',
                'time' => now()->subHours(3),
            ],
            [
                'type' => 'info',
                'message' => 'System update available',
                'time' => now()->subHours(12),
            ],
            [
                'type' => 'success',
                'message' => 'Backup completed successfully',
                'time' => now()->subDays(1),
            ],
        ]);

        // Get summary statistics
        $stats = [
            'total_users' => Akun::count(),
            'total_content' => Konten::count(),
            'total_events' => Event::count(),
            'total_views' => Konten::sum('views_count') + Event::sum('views_count'),
            'new_users_today' => Akun::whereDate('created_at', today())->count(),
            'new_content_today' => Konten::whereDate('created_at', today())->count(),
        ];

        return view('admin.dashboard', compact(
            'dateRange',
            'visitorData',
            'pageViewData',
            'deviceStats',
            'browserStats',
            'trafficSources',
            'userDemographics',
            'popularContent',
            'recentActivities',
            'systemStatus',
            'notifications',
            'stats'
        ));
    }

    public function showLogin() {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|min:8',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal terdiri dari 8 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->except('password'));
        } elseif (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Ambil data user yang berhasil login
            $user = Auth::user();
            $username = $user->username;
            $role = $user->id_role; // Ambil id_role pengguna

            // Simpan nama ke session flash data
            $request->session()->flash('nama_login', $username);
            $request->session()->flash('alert_tampil', true);

            // Periksa id_role dan arahkan ke route yang sesuai
            if ($role === 1) {
                return redirect()->intended('admin/admin/dashboard');
            } elseif ($role === 2) {

                return redirect(route('home'));
            } else {
                return redirect()->intended('index')->with('warning', 'Peran pengguna tidak dikenali.');
            }
        } else {
            return redirect()->back()->with('error', 'Username atau password tidak terdaftar.');
        }
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}

