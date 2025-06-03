<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Akun;

class AkunSeeder extends Seeder
{
    public function run(): void
    {
        Akun::create([
            'username' => 'admin123',
            'email' => 'admin@budayanesia.com',
            'nomor_hp' => '081234567890',
            'password' => Hash::make('admin123'),
            'id_role' => 1,
        ]);

        Akun::create([
            'username' => 'user123',
            'email' => 'user@budayanesia.com',
            'nomor_hp' => '089876543210',
            'password' => Hash::make('user12345'),
            'id_role' => 2,
        ]);

        Akun::create([
            'username' => 'user2',
            'email' => 'user2@budayanesia.com',
            'nomor_hp' => '089876543211',
            'password' => Hash::make('user22222'),
            'id_role' => 2,
        ]);

        Akun::create([
            'username' => 'user3',
            'email' => 'user3@budayanesia.com',
            'nomor_hp' => '089876543212',
            'password' => Hash::make('user33333'),
            'id_role' => 2,
        ]);

    }
}

