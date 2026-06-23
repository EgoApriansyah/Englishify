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
}
