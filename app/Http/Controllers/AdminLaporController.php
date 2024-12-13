<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminLaporController extends Controller
{

    public function index()
    {

        $reports = [
            ['id' => 1, 'name' => 'Angga Septian', 'date' => '2024-12-01', 'status' => 'Diproses'],
            ['id' => 2, 'name' => 'Ali Mashar Saputra', 'date' => '2024-12-02', 'status' => 'Disetujui'],
            ['id' => 3, 'name' => 'Harya Octagya Dzaky', 'date' => '2024-12-03', 'status' => 'Diajukan'],
            ['id' => 4, 'name' => 'Putri Amelia', 'date' => '2024-12-04', 'status' => 'Selesai'],
        ];

        return view('admin.reports', ['reports' => $reports]);
    }

    public function show($id)
    {

        $reportDetails = [
            1 => ['id' => 1, 'name' => 'Angga Septian', 'date' => '2024-12-01', 'status' => 'Diproses' ],
            2 => ['id' => 2, 'name' => 'Ali Mashar Saputra', 'date' => '2024-12-02', 'status' => 'Disetujui'],
            3 => ['id' => 3, 'name' => 'Harya Octagya Dzaky', 'date' => '2024-12-03', 'status' => 'Diajukan'],
            4 => ['id' => 4, 'name' => 'Putri Amelia', 'date' => '2024-12-04', 'status' => 'Selesai'],
        ];

        return view('admin.reports-detail', ['report' => $reportDetails[$id]]);
    }
}
