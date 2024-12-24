<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LapController extends Controller
{
    private $reports = [
        [
            'id' => 1,
            'image' => 'sampah.png',
            'title' => 'Saya ingin melaporkan adanya penumpukan sampah di lokasi Jl. Melati, RT. Surabaya',
            'date' => ' Januari 2024',
            'status' => 'Diajukan',
            'description' => 'Tumpukan sampah di Jl. Melati sudah berlangsung selama beberapa minggu...',
            'additional_images' => ['sampah.png', 'sampah.png', 'sampah.png'],
        ],
        [
            'id' => 2,
            'image' => 'lampu.png',
            'title' => 'Saya ingin melaporkan masalah lampu jalan yang tidak berfungsi di lokasi Jl. Pahlawan...',
            'date' => '8 Juni 2024',
            'status' => 'Diproses',
            'description' => 'Lampu jalan di Jl. Pahlawan tidak menyala selama beberapa malam...',
            'additional_images' => ['lampu.png', 'lampu.png', 'lampu.png'],
        ],
        [
            'id' => 3,
            'image' => 'jalan.png',
            'title' => 'Saya ingin melaporkan kondisi jalan yang rusak di Jl. Merdeka RT 04 RW 03...',
            'date' => '5 November 2024',
            'status' => 'Selesai',
            'description' => 'Kondisi jalan di Jl. Merdeka sudah sangat rusak parah...',
            'additional_images' => ['jalan.png', 'jalan.png', 'jalan.png'],
        ],
    ];

    public function index()
    {
        return view('laporan', ['reports' => $this->reports]);
    }

    public function notifications()
    {
        return view('notifications', ['notifications' => $this->reports]);
    }


    public function show($id)
    {
        $report = collect($this->reports)->firstWhere('id', $id);

        if (!$report) {
            abort(404, 'Laporan tidak ditemukan.');
        }

        return view('laporan-detail', [
            'detail' => $report,
            'status' => $report['status'],
        ]);
    }


}
