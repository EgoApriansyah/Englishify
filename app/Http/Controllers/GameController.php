<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display the Sentence Builder game.
     */
    public function index()
    {
        return view('game.index');
    }
}
