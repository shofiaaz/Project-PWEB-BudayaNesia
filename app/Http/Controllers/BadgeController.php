<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;
use App\Models\Konten;
use App\Models\BadgeLevel;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class BadgeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $this->updateUserBadgeLevel($user->id);

        $topUsers = Akun::with('badgeLevel')
            ->join('badge_levels', 'akun.id', '=', 'badge_levels.akun_id')
            ->orderByDesc('badge_levels.poin')
            ->take(10)
            ->get();

        $topContents = Konten::where('akun_id', $user->id)
            ->where('status', 'approved')
            ->orderByDesc('views_count')
            ->take(10)
            ->get();

        $userBadge = BadgeLevel::where('akun_id', $user->id)->first();
        $badgeInfo = $this->getBadgeInfo($userBadge ? $userBadge->poin : 0);

        return view('user.badge.index', compact('topUsers', 'topContents', 'userBadge', 'badgeInfo'));
    }


    private function updateUserBadgeLevel($userId)
    {
        // Count approved content for the user
        $approvedContentCount = Konten::where('akun_id', $userId)
            ->where('status', 'approved')
            ->count();

        // Calculate points
        $totalPoin = $approvedContentCount * 100;

        $badgeStatus = $this->determineBadgeStatus($totalPoin);

        BadgeLevel::updateOrCreate(
            ['akun_id' => $userId],
            [
                'poin' => $totalPoin,
                'status' => $badgeStatus,
                'konten_approved' => $approvedContentCount
            ]
        );
    }

    private function determineBadgeStatus($poin)
    {
        if ($poin >= 2000) {
            return 'Sultan';
        } elseif ($poin >= 1001) {
            return 'Mahapatih';
        } elseif ($poin >= 501) {
            return 'Adipati';
        } elseif ($poin >= 101) {
            return 'Panewu';
        } else {
            return 'Abdi';
        }
    }

    /**
     * Get badge information including current level and next level requirements
     */
    private function getBadgeInfo($currentPoin)
    {
        $badges = [
            ['name' => 'Abdi', 'min' => 0, 'max' => 100, 'level' => 1, 'icon' => 'fas fa-user', 'color' => 'from-gray-300 to-gray-400'],
            ['name' => 'Panewu', 'min' => 101, 'max' => 500, 'level' => 2, 'icon' => 'fas fa-user-shield', 'color' => 'from-yellow-200 to-yellow-400'],
            ['name' => 'Adipati', 'min' => 501, 'max' => 1000, 'level' => 3, 'icon' => 'fas fa-crown', 'color' => 'from-blue-300 to-blue-500'],
            ['name' => 'Mahapatih', 'min' => 1001, 'max' => 2000, 'level' => 4, 'icon' => 'fas fa-chess-queen', 'color' => 'from-purple-300 to-purple-500'],
            ['name' => 'Sultan', 'min' => 2000, 'max' => null, 'level' => 5, 'icon' => 'fas fa-gem', 'color' => 'from-red-400 to-budanes-darker'],
        ];

        $currentBadge = null;
        $nextBadge = null;

        foreach ($badges as $index => $badge) {
            if ($currentPoin >= $badge['min'] && ($badge['max'] === null || $currentPoin <= $badge['max'])) {
                $currentBadge = $badge;
                $nextBadge = isset($badges[$index + 1]) ? $badges[$index + 1] : null;
                break;
            }
        }

        $progress = 0;
        if ($currentBadge && $nextBadge) {
            $rangeSize = $nextBadge['min'] - $currentBadge['min'];
            $currentProgress = $currentPoin - $currentBadge['min'];
            $progress = ($currentProgress / $rangeSize) * 100;
        } elseif ($currentBadge && $currentBadge['name'] === 'Sultan') {
            $progress = 100;
        }

        return [
            'current' => $currentBadge,
            'next' => $nextBadge,
            'progress' => $progress,
            'currentPoin' => $currentPoin
        ];
    }

    /**
     * Manually recalculate all users' badge levels (for admin use)
     */
    public function recalculateAllBadges()
    {
        $users = Akun::all();

        foreach ($users as $user) {
            $this->updateUserBadgeLevel($user->id);
        }

        Alert::success('Success', 'All user badge levels have been recalculated');
        return redirect()->back();
    }
}
