<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    /**
     * Display the Sentence Builder game.
     */
    public function index()
    {
        return view('game.index');
    }

    /**
     * Save the game XP to the user's account.
     */
    public function saveXp(Request $request)
    {
        $request->validate([
            'xp' => 'required|integer|min:0'
        ]);

        $user = Auth::user();
        if ($user) {
            $user->xp += $request->input('xp');
            $user->save();

            return response()->json([
                'success' => true,
                'new_xp' => $user->xp
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
    }
}
