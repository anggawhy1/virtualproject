<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RewardsAdminController extends Controller
{

    public function index()
    {

        $rewards = [
            ['id' => 1, 'name' => 'Lulu', 'profile' => 'images/pict1.png', 'points' => 3, 'status' => '-'],
            ['id' => 2, 'name' => 'Sumbul', 'profile' => 'images/pict1.png', 'points' => 13, 'status' => 'Permintaan Penukaran Hadiah'],
            ['id' => 3, 'name' => 'Nazmi', 'profile' => 'images/pict1.png', 'points' => 32, 'status' => '-'],
            ['id' => 4, 'name' => 'Amora', 'profile' => 'images/pict1.png', 'points' => 2, 'status' => 'Permintaan Penukaran Hadiah'],
            ['id' => 5, 'name' => 'Lala', 'profile' => 'images/pict1.png', 'points' => 10, 'status' => 'Permintaan Penukaran Hadiah'],
            ['id' => 6, 'name' => 'Lili', 'profile' => 'images/pict1.png', 'points' => 33, 'status' => 'Permintaan Penukaran Hadiah'],
            ['id' => 7, 'name' => 'Mimi', 'profile' => 'images/pict1.png', 'points' => 73, 'status' => '-'],
            ['id' => 8, 'name' => 'Lex', 'profile' => 'images/pict1.png', 'points' => 12, 'status' => '-'],
        ];

        return view('admin.rewards', ['rewards' => $rewards]);
    }

    public function show($id)
    {

        $reward = [
            1 => ['id' => 1, 'name' => 'Lulu', 'profile' => 'images/pict1.png', 'points' => 3, 'status' => '-'],
            2 => ['id' => 2, 'name' => 'Sumbul', 'profile' => 'images/pict1.png', 'points' => 13, 'status' => 'Permintaan Penukaran Hadiah'],
            3 => ['id' => 3, 'name' => 'Nazmi', 'profile' => 'images/pict1.png', 'points' => 32, 'status' => '-'],
            4 => ['id' => 4, 'name' => 'Amora', 'profile' => 'images/pict1.png', 'points' => 2, 'status' => 'Permintaan Penukaran Hadiah'],
            5 => ['id' => 5, 'name' => 'Lala', 'profile' => 'images/pict1.png', 'points' => 10, 'status' => 'Permintaan Penukaran Hadiah'],
            6 => ['id' => 6, 'name' => 'Lili', 'profile' => 'images/pict1.png', 'points' => 33, 'status' => 'Permintaan Penukaran Hadiah'],
            7 => ['id' => 7, 'name' => 'Mimi', 'profile' => 'images/pict1.png', 'points' => 73, 'status' => '-'],
            8 => ['id' => 8, 'name' => 'Lex', 'profile' => 'images/pict1.png', 'points' => 12, 'status' => '-'],
        ];

        return view('admin.reward-detail', ['reward' => $reward[$id]]);
    }
}
