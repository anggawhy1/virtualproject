<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {

        $users = [
            ['id' => 1, 'name' => 'Anggaaa', 'email' => 'septian@example.com', 'phone' => '081234567890', 'role' => 'Admin', 'profile' => 'public/images/Logo.png', 'address' => 'Desa Babakbawo, Gresik', 'dob' => '1999-12-01', 'profile' => 'images/pict1.png'],
            ['id' => 2, 'name' => 'Ali Mashar Saputra', 'email' => 'ali@example.com', 'phone' => '081234567891', 'role' => 'User', 'profile' => 'public/images/Logo.png', 'address' => 'Jalan Raya, Jakarta', 'dob' => '1998-10-22', 'profile' => 'images/pict1.png'],
            ['id' => 3, 'name' => 'Harya Octagya Dzaky', 'email' => 'harya@example.com', 'phone' => '081234567892', 'role' => 'Admin', 'profile' => 'public/images/Logo.png', 'address' => 'Kampung Sejahtera, Medan', 'dob' => '2000-08-15', 'profile' => 'images/pict1.png'],
        ];

        return view('admin.users', ['users' => $users]);
    }

    public function show($id)
    {

        $user = [
            1 => ['id' => 1, 'name' => 'Anggaaa', 'email' => 'septian@example.com', 'phone' => '081234567890', 'role' => 'Admin', 'address' => 'Desa Babakbawo, Gresik', 'dob' => '1999-12-01', 'profile' => 'images/pict1.png'],
            2 => ['id' => 2, 'name' => 'Ali Mashar Saputra', 'email' => 'ali@example.com', 'phone' => '081234567891', 'role' => 'User', 'address' => 'Jalan Raya, Jakarta', 'dob' => '1998-10-22', 'profile' => 'images/pict1.png'],
            3 => ['id' => 3, 'name' => 'Harya Octagya Dzaky', 'email' => 'harya@example.com', 'phone' => '081234567892', 'role' => 'Admin', 'address' => 'Kampung Sejahtera, Medan', 'dob' => '2000-08-15', 'profile' => 'images/pict1.png'],
        ];

        return view('admin.user-detail', ['user' => $user[$id]]);
    }
}
