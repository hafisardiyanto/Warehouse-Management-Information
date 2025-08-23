<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CabaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cabais')->insert([
            'name' => 'Cabai Merah',
            'image' => 'cabai-merah.jpg',
            'description' => 'Cabai merah adalah buah tanaman yang memiliki rasa pedas, digunakan sebagai bumbu utama dalam masakan untuk menambah cita rasa dan aroma yang kuat.',
        ]);

        DB::table('cabais')->insert([
            'name' => 'Cabai Hijau',
            'image' => 'cabai-hijau.jpg',
            'description' => 'Cabai hijau adalah varietas cabai yang belum matang sepenuhnya, memiliki rasa pedas yang lebih ringan dibanding cabai merah, sering digunakan untuk memberikan rasa segar dan sedikit pedas dalam masakan.',
        ]);
    }
}
