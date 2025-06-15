<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;
use App\Models\Konten;
use App\Models\BadgeLevel;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BadgeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $user->loadMissing('badgeLevel');

        $badgeLevel = $user->badgeLevel;


        $quizCompleted = $badgeLevel ? $badgeLevel->quiz_completed : false;
        $quizScore = $badgeLevel ? $badgeLevel->quiz_score : 0;


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

        $userBadge = $badgeLevel;
        $usersekarang = Auth::user();

        $badgeInfo = $this->getBadgeInfo($userBadge ? $userBadge->poin : 0);

        return view('user.badge.index', compact('topUsers', 'topContents', 'userBadge', 'badgeInfo', 'quizCompleted', 'quizScore', 'usersekarang'));
    }

    public function quiz()
    {
        $user = Auth::user();


        $quizCompleted = auth()->user()->quiz_completed ?? false;
        $quizScore = auth()->user()->quiz_score ?? 0;

        return view('user.badge.quiz', compact('quizCompleted', 'quizScore'));
    }


    private function updateUserBadgeLevel($userId)
    {
        $approvedContentCount = Konten::where('akun_id', $userId)
            ->where('status', 'approved')
            ->count();

        $badgeLevel = BadgeLevel::where('akun_id', $userId)->first();

        if (!$badgeLevel) {
            return;
        }

        $totalPoin = ($approvedContentCount * 100) + $badgeLevel->quiz_score;
        $badgeStatus = $this->determineBadgeStatus($totalPoin);

        $badgeLevel->update([
            'poin' => $totalPoin,
            'status' => $badgeStatus,
            'konten_approved' => $approvedContentCount
        ]);
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

    public function recalculateAllBadges()
    {
        $users = Akun::all();

        foreach ($users as $user) {
            $this->updateUserBadgeLevel($user->id);
        }

        Alert::success('Success', 'All user badge levels have been recalculated');
        return redirect()->back();
    }

    public function submitQuiz(Request $request)
    {
        $user = auth()->user();
        $badgeLevel = BadgeLevel::firstOrCreate(
            ['akun_id' => $user->id],
            ['poin' => 0, 'status' => 'Abdi', 'konten_approved' => 0, 'quiz_completed' => false, 'quiz_score' => 0]
        );

        if ($badgeLevel->quiz_completed) {
            return redirect()->route('badge.index')->with([
                'quiz_submission_status' => 'error',
                'quiz_submitted_message' => 'Anda sudah menyelesaikan kuis ini.'
            ]);
        }

        $answers = [
            'question1' => 'A',
            'question2' => 'C',
            'question3' => 'A',
            'question4' => [
                'a' => 'Aceh',
                'b' => 'Jawa Barat'
            ],
            'question5' => 'A'
        ];

        $score = 0;

        // Penilaian jawaban
        if ($request->question1 === $answers['question1']) $score += 20;
        if ($request->question2 === $answers['question2']) $score += 20;
        if ($request->question3 === $answers['question3']) $score += 20;
        if ($request->question4a === $answers['question4']['a']) $score += 10;
        if ($request->question4b === $answers['question4']['b']) $score += 10;
        if ($request->question5 === $answers['question5']) $score += 20;

        DB::beginTransaction();
        try {
            $badgeLevel->update([
                'quiz_completed' => true,
                'quiz_score' => $score,
                'poin' => $badgeLevel->poin + $score
            ]);

            $this->updateUserBadgeLevel($user->id);
            DB::commit();

            return redirect()->route('badge.index')->with([
                'quiz_submission_status' => 'success',
                'quiz_submitted_message' => 'Kuis berhasil disubmit! Anda mendapatkan '.$score.' poin.',
                'quiz_submitted_score' => $score
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with([
                'quiz_submission_status' => 'error',
                'quiz_submitted_message' => 'Gagal menyimpan hasil kuis: '.$e->getMessage()
            ]);
        }
    }
}
