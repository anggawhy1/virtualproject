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
        // Menambahkan data pengguna admin
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

        // Memanggil seeder lain
        $this->call([
            RewardSeeder::class,
            // Tambahkan seeder lain jika ada
        ]);
    }
}
