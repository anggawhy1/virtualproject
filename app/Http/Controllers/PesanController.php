<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function index()
    {
        $messages = [
            [
                'id' => 1,
                'name' => 'Lulu',
                'email' => 'lulu5688@gmail.com',
                'content' => 'Halo Admin, saya ingin bertanya terkait status laporan jalan rusak saya.',
                'time' => '10.40',
                'unread' => true,
                'photo' => 'images/pict1.png',
            ],
            [
                'id' => 2,
                'name' => 'Budi Santoso',
                'email' => 'budi123@gmail.com',
                'content' => 'Halo Admin, saya ingin menambahkan informasi terkait laporan saya.',
                'time' => '10.20',
                'unread' => false,
                'photo' => 'images/user2.png',
            ],
            [
                'id' => 3,
                'name' => 'Dina Ramadhani',
                'email' => 'dina.ramadhani@gmail.com',
                'content' => 'Selamat pagi, saya ingin bertanya terkait lampu jalan mati.',
                'time' => '09.45',
                'unread' => true,
                'photo' => 'images/user3.png',
            ],
        ];

        return view('admin.message', ['messages' => $messages]);
    }

    public function show($id)
    {
        $message = [
            'id' => $id,
            'name' => 'Rina Kartika',
            'email' => 'rina.kartika89@gmail.com',
            'photo' => 'images/pict1.png',
        ];

        $chats = [
            [
                'type' => 'user',
                'message' => 'Selamat pagi, saya ingin bertanya terkait lampu jalan mati di daerah saya sudah diproses?',
                'time' => '09.32',
            ],
            [
                'type' => 'admin',
                'message' => 'Selamat pagi, laporan Anda sedang kami proses dan akan kami konfirmasi lebih lanjut.',
                'time' => '09.35',
            ],
            [
                'type' => 'user',
                'message' => 'Terima kasih atas responnya.',
                'time' => '09.37',
            ],
        ];

        return view('admin.message-detail', ['message' => $message, 'chats' => $chats]);
    }
}
