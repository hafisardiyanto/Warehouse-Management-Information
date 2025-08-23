<?php

namespace Database\Seeders;

use App\Models\Cabai;
use App\Models\Gudang;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CabaiSeeder::class,
            GudangSeeder::class,
            KomoditasSeeder::class,
        ]);
    }
}
