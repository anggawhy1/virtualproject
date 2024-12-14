<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rewards = [
            ['slug' => 'voucher-belanja', 'name' => 'Voucher Belanja', 'points' => 10, 'icon' => 'voucher.png', 'description' => 'Tukarkan point anda untuk voucher belanja menarik!'],
            ['slug' => 'merchandise', 'name' => 'Merchandise', 'points' => 20, 'icon' => 'merchandise.png', 'description' => 'Dapatkan merchandise eksklusif dari kami.'],
            ['slug' => 'discount-belanja', 'name' => 'Discount Belanja', 'points' => 40, 'icon' => 'diskon.png', 'description' => 'Dapatkan diskon belanja hingga 40%.'],
            ['slug' => 'hadiah-special', 'name' => 'Hadiah Special', 'points' => 50, 'icon' => 'hadiah.png', 'description' => 'Hadiah special untuk anda yang aktif.'],
            ['slug' => 'tiket-liburan', 'name' => 'Tiket Liburan', 'points' => 100, 'icon' => 'tiket.png', 'description' => 'Tiket liburan gratis ke tempat pilihan.'],
            ['slug' => 'gadget', 'name' => 'Gadget', 'points' => 500, 'icon' => 'gadgets.png', 'description' => 'Dapatkan gadget impian anda dengan point reward.'],
        ];

        DB::table('rewards')->insert($rewards);
    }
}
