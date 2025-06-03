<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Akun;
use App\Models\Konten;
use App\Models\BadgeLevel;

class BadgeLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users
        $users = Akun::all();

        foreach ($users as $user) {
            // Count approved content for each user
            $approvedContentCount = Konten::where('akun_id', $user->id)
                ->where('status', 'approved')
                ->count();

            // Calculate points (10 points per approved content)
            $totalPoin = $approvedContentCount * 10;

            // Determine badge status
            $badgeStatus = $this->determineBadgeStatus($totalPoin);

            // Create or update badge level
            BadgeLevel::updateOrCreate(
                ['akun_id' => $user->id],
                [
                    'poin' => $totalPoin,
                    'status' => $badgeStatus,
                    'konten_approved' => $approvedContentCount
                ]
            );
        }

        $this->command->info('Badge levels have been seeded for all users!');
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
