<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display the game portal.
     */
    public function index()
    {
        return view('game.index');
    }

    /**
     * Display the 3D game.
     */
    public function game3d()
    {
        return view('game.3d');
    }
}
