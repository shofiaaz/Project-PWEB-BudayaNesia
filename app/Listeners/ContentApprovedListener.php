<?php

namespace App\Listeners;

use App\Events\ContentApproved;
use App\Models\BadgeLevel;
use App\Models\Konten;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ContentApprovedListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(ContentApproved $event): void
    {
        $content = $event->content;
        $this->updateUserBadgeLevel($content->akun_id);
    }

    /**
     * Update user badge level based on approved content
     */
    private function updateUserBadgeLevel($userId)
    {
        // Count approved content for the user
        $approvedContentCount = Konten::where('akun_id', $userId)
            ->where('status', 'approved')
            ->count();

        // Calculate points (10 points per approved content)
        $totalPoin = $approvedContentCount * 10;

        // Determine badge status based on points
        $badgeStatus = $this->determineBadgeStatus($totalPoin);

        // Update or create badge level record
        BadgeLevel::updateOrCreate(
            ['akun_id' => $userId],
            [
                'poin' => $totalPoin,
                'status' => $badgeStatus,
                'konten_approved' => $approvedContentCount
            ]
        );
    }

    /**
     * Determine badge status based on points
     */
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
}
