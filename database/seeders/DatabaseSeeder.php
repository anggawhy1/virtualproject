<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            'nama_lengkap' => 'Admin',
            'email' => 'admin@example.com',
            'phone' => '081234567890',
            'lokasi' => 'Jakarta',
            'password' => Hash::make('password'), // Ganti dengan password aman
            'role' => 'admin',
            'gender' => 'Laki-laki', // Optional
            'profile_photo' => null, // Optional
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
