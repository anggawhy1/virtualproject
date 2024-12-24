<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Memanggil seeder lain
        $this->call([
            RewardSeeder::class,
            BadgeSeeder::class,
        ]);

        // Menambahkan data pengguna admin
        DB::table('users')->insert([
            'nama_lengkap' => 'Admin',
            'email' => 'admin@example.com',
            'phone' => '081234567890',
            'lokasi' => 'Jakarta',
            'password' => Hash::make('password'), // Ganti dengan password aman
            'role' => 'admin',
            'gender' => 'Laki-laki',
            'badge_id'=> 1,
            'profile_photo' => null, // Optional
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

