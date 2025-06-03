<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Akun;
use App\Models\Konten;
use App\Models\BadgeLevel;

class BadgeLevelSeeder extends Seeder
{

    public function run(): void
    {
        //get semua user kecuali atmin
        $users = Akun::where('username', '!=', 'admin123')->get();

        foreach ($users as $user) {
            $approvedContentCount = Konten::where('akun_id', $user->id)
                ->where('status', 'approved')
                ->count();

            $totalPoin = $approvedContentCount * 100;

            $badgeStatus = $this->determineBadgeStatus($totalPoin);

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
