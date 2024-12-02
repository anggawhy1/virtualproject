<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function show($id)
    {

        $rewards = [
            'voucher-belanja' => [
                'id' => 'voucher-belanja',
                'title' => 'Voucher Belanja',
                'description' => 'Belanja jadi lebih hemat dengan voucher belanja seharga 10 poin! Voucher ini dapat digunakan di berbagai toko mitra kami, mulai dari supermarket hingga toko fashion favoritmu. Manfaatkan kesempatan ini untuk mendapatkan barang yang kamu inginkan dengan harga lebih murah. Belanja cerdas dan hemat hanya dengan menukarkan 10 poinmu!.',
                'points' => 10,
                'icon' => 'voucher.png',
            ],
            'merchandise' => [
                'id' => 'merchandise',
                'title' => 'Merchandise',
                'description' => 'Miliki merchandise eksklusif dari kami dengan menukarkan 20 poin. Dapatkan item spesial seperti botol minum yang stylish, tote bag ramah lingkungan, atau aksesoris unik lainnya yang hanya bisa didapatkan oleh pengguna setia. Merchandise ini dirancang dengan desain modern dan fungsional, cocok untuk digunakan sehari-hari. Tunjukkan gaya unikmu dengan produk eksklusif ini!.',
                'points' => 20,
                'icon' => 'merchandise.png',
            ],
            'discount-belanja' => [
                'id' => 'discount-belanja',
                'title' => 'Discount Belanja',
                'description' => 'Tukarkan 40 poin untuk mendapatkan diskon belanja sebesar 20%! Diskon ini berlaku di berbagai merchant pilihan kami, mulai dari fashion hingga kebutuhan sehari-hari. Hemat lebih banyak saat berbelanja barang favoritmu dengan memanfaatkan diskon spesial ini. Jadikan pengalaman belanja lebih menyenangkan dan hemat dengan reward diskon dari kami.',
                'points' => 40,
                'icon' => 'diskon.png',
            ],
            'hadiah-special' => [
                'id' => 'hadiah-special',
                'title' => 'Hadiah Special',
                'description' => 'Ingin sesuatu yang spesial? Tukarkan 50 poinmu untuk mendapatkan hadiah eksklusif yang telah kami persiapkan khusus untukmu. Hadiah ini merupakan kejutan menarik yang bisa berupa barang premium, voucher, atau pengalaman spesial yang tak ternilai. Cocok untuk memanjakan dirimu sendiri atau sebagai hadiah bagi orang terdekat. Jangan lewatkan kesempatan ini untuk mendapatkan sesuatu yang benar-benar istimewa!.',
                'points' => 50,
                'icon' => 'hadiah.png',
            ],
            'tiket-liburan' => [
                'id' => 'tiket-liburan',
                'title' => 'Tiket Liburan',
                'description' => 'Rencanakan liburan impianmu dengan tiket liburan yang dapat ditukarkan dengan 100 poin. Voucher ini bisa digunakan untuk berlibur ke destinasi pilihanmu atau sebagai potongan harga untuk paket wisata. Baik untuk perjalanan domestik maupun internasional, tiket liburan ini akan menjadikan momen liburanmu lebih terjangkau dan berkesan. Tukarkan poinmu dan siapkan dirimu untuk pengalaman liburan yang menyenangkan!.',
                'points' => 100,
                'icon' => 'tiket.png',
            ],
            'gadget' => [
                'id' => 'gadget',
                'title' => 'Gadget',
                'description' => 'Dapatkan gadget terbaru dengan menukarkan 500 poin! Pilih dari berbagai aksesori elektronik seperti earphone, power bank, atau perangkat canggih lainnya yang dapat mendukung aktivitas harianmu. Gadget ini dipilih dengan kualitas terbaik untuk memastikan kepuasan pengguna. Cocok untuk kamu yang suka teknologi dan ingin selalu up-to-date dengan perangkat terbaru. Tukarkan poinmu dan nikmati pengalaman baru dengan gadget pilihan!.',
                'points' => 500,
                'icon' => 'gadgets.png',
            ],
        ];

        if (!array_key_exists($id, $rewards)) {
            abort(404, 'Hadiah tidak ditemukan.');
        }

        return view('reward-detail', ['reward' => $rewards[$id]]);
    }
}
