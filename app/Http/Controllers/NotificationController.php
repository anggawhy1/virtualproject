<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    private $notifications = [
        1 => [
            'id' => 1,
            'title' => 'Laporan Anda Telah Diverifikasi',
            'message' => 'Laporan kamu dengan nomor aduan 1 telah berhasil diverifikasi! Terima kasih atas kontribusi kamu dalam melaporkan kondisi di sekitar. Saat ini, laporan kamu sedang dalam proses untuk ditindaklanjuti oleh tim terkait. Kamu bisa memantau perkembangan dan status terbaru dari laporan tersebut dengan mengunjungi halaman "Lacak Aduan" di platform kami. Kami sangat menghargai peran aktifmu dalam menjaga dan membangun lingkungan yang lebih baik. Terus berpartisipasi untuk perubahan positif di komunitasmu!',
            'date' => '1 Januari 2024'
        ],
        2 => [
            'id' => 2,
            'title' => 'Laporan Anda Telah Disetujui',
            'message' => 'Laporan kamu dengan nomor aduan 2 telah berhasil diverifikasi! Terima kasih atas kontribusi kamu dalam melaporkan kondisi di sekitar. Saat ini, laporan kamu sedang dalam proses untuk ditindaklanjuti oleh tim terkait. Kamu bisa memantau perkembangan dan status terbaru dari laporan tersebut dengan mengunjungi halaman "Lacak Aduan" di platform kami. Kami sangat menghargai peran aktifmu dalam menjaga dan membangun lingkungan yang lebih baik. Terus berpartisipasi untuk perubahan positif di komunitasmu',
            'date' => '2 Januari 2024'
        ],
        3 => [
            'id' => 3,
            'title' => 'Anda Berhasil Mengajukan Laporan',
            'message' => 'Laporan kamu dengan nomor aduan 3 telah berhasil diverifikasi! Terima kasih atas kontribusi kamu dalam melaporkan kondisi di sekitar. Saat ini, laporan kamu sedang dalam proses untuk ditindaklanjuti oleh tim terkait. Kamu bisa memantau perkembangan dan status terbaru dari laporan tersebut dengan mengunjungi halaman "Lacak Aduan" di platform kami. Kami sangat menghargai peran aktifmu dalam menjaga dan membangun lingkungan yang lebih baik. Terus berpartisipasi untuk perubahan positif di komunitasmu',
            'date' => '3 Januari 2024'
        ]
    ];

    public function index()
    {
        return view('notifications', ['notifications' => $this->notifications]);
    }

    public function show($id)
    {
        if (!array_key_exists($id, $this->notifications)) {
            abort(404, 'Notifikasi tidak ditemukan');
        }

        $notification = $this->notifications[$id];

        return view('notification-detail', compact('notification'));
    }
}
