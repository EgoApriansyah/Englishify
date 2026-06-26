<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the student dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // Get test history
        $sessions = $user->testSessions()
            ->orderBy('started_at', 'desc')
            ->get();

        // Find the last completed test session to show last score
        $lastCompletedSession = $user->testSessions()
            ->whereNotNull('finished_at')
            ->orderBy('finished_at', 'desc')
            ->first();

        $lastScore = null;
        if ($lastCompletedSession) {
            // Calculate correct answers for the last completed session
            $correctListening = $lastCompletedSession->answers()
                ->whereHas('question', function ($query) {
                    $query->where('section', 'listening');
                })
                ->where('is_correct', true)
                ->count();

            $correctStructure = $lastCompletedSession->answers()
                ->whereHas('question', function ($query) {
                    $query->where('section', 'structure');
                })
                ->where('is_correct', true)
                ->count();

            $correctReading = $lastCompletedSession->answers()
                ->whereHas('question', function ($query) {
                    $query->where('section', 'reading');
                })
                ->where('is_correct', true)
                ->count();

            // Calculate TOEFL ITP score
            $listeningScaled  = round(31 + ($correctListening / 18) * 37);
            $structureScaled  = round(31 + ($correctStructure / 20) * 37);
            $readingScaled    = round(31 + ($correctReading / 35) * 37);
            $lastScore = round((($listeningScaled + $structureScaled + $readingScaled) / 3) * 10);
        }

        // Check if there is an active (unfinished) session
        $activeSession = $user->testSessions()
            ->whereNull('finished_at')
            ->first();

        return view('dashboard', compact('user', 'sessions', 'lastScore', 'activeSession'));
    }
}
