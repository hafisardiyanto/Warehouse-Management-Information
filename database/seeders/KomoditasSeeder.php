<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KomoditasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('komoditas')->insert([
            'cabai_id' => 1,
            'user_id' => 3,
            'gudang_id' => null,
            'quantity' => 5,
            'status' => 'pengajuan',
        ]);

        DB::table('komoditas')->insert([
            'cabai_id' => 1,
            'user_id' => 4,
            'gudang_id' => 1,
            'quantity' => 5,
            'status' => 'diterima',
        ]);

        DB::table('komoditas')->insert([
            'cabai_id' => 1,
            'user_id' => 3,
            'gudang_id' => 1,
            'quantity' => 5,
            'status' => 'ditolak',
        ]);
        DB::table('komoditas')->insert([
            'cabai_id' => 1,
            'user_id' => 5,
            'gudang_id' => null,
            'quantity' => 5,
            'status' => 'pengajuan',
        ]);

        DB::table('komoditas')->insert([
            'cabai_id' => 1,
            'user_id' => 3,
            'gudang_id' => 1,
            'quantity' => 5,
            'status' => 'diterima',
        ]);

        DB::table('komoditas')->insert([
            'cabai_id' => 1,
            'user_id' => 4,
            'gudang_id' => 1,
            'quantity' => 5,
            'status' => 'ditolak',
        ]);
    }
}
