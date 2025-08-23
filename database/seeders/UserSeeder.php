<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Udin',
            'email' => 'udin@gmail.com',
            'role' => 'pengelola gudang',
            'password' => Hash::make('inipassword')
        ]);

        DB::table('users')->insert([
            'name' => 'Ahmad',
            'email' => 'ahmad@gmail.com',
            'role' => 'pengelola gudang',
            'password' => Hash::make('inipassword')
        ]);

        DB::table('users')->insert([
            'name' => 'Asep',
            'email' => 'asep@gmail.com',
            'role' => 'petani',
            'password' => Hash::make('inipassword')
        ]);

        DB::table('users')->insert([
            'name' => 'Samsul',
            'email' => 'samsul@gmail.com',
            'role' => 'petani',
            'password' => Hash::make('inipassword')
        ]);

        DB::table('users')->insert([
            'name' => 'Jamal',
            'email' => 'jamal@gmail.com',
            'role' => 'petani',
            'password' => Hash::make('inipassword')
        ]);
    }
}
