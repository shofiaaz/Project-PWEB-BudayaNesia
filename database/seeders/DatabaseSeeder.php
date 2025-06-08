<?php

namespace Database\Seeders;

use App\Models\Akun;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AkunSeeder::class,
            // KontenSeeder::class,
            BadgeLevelSeeder::class,
        ]);
    }
}
