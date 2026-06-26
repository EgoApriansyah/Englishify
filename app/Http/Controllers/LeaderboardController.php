<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TestSession;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    /**
     * Display the leaderboard page.
     */
    public function index()
    {
        $users = User::all();
        $leaderboard = [];

        foreach ($users as $user) {
            $highestScore = 0;
            $highestSession = null;

            // Get all finished test sessions for the user
            $completedSessions = $user->testSessions()
                ->whereNotNull('finished_at')
                ->get();

            foreach ($completedSessions as $session) {
                // Calculate correct answers
                $correctListening = $session->answers()
                    ->whereHas('question', function ($query) {
                        $query->where('section', 'listening');
                    })
                    ->where('is_correct', true)
                    ->count();

                $correctStructure = $session->answers()
                    ->whereHas('question', function ($query) {
                        $query->where('section', 'structure');
                    })
                    ->where('is_correct', true)
                    ->count();

                $correctReading = $session->answers()
                    ->whereHas('question', function ($query) {
                        $query->where('section', 'reading');
                    })
                    ->where('is_correct', true)
                    ->count();

                // Compute standard scale score of TOEFL ITP (310 - 677)
                $listeningScaled  = round(31 + ($correctListening / 18) * 37);
                $structureScaled  = round(31 + ($correctStructure / 20) * 37);
                $readingScaled    = round(31 + ($correctReading / 35) * 37);
                $totalScore = round((($listeningScaled + $structureScaled + $readingScaled) / 3) * 10);

                if ($totalScore > $highestScore) {
                    $highestScore = $totalScore;
                    $highestSession = $session;
                }
            }

            if ($highestScore > 0) {
                $leaderboard[] = [
                    'user' => $user,
                    'score' => $highestScore,
                    'session' => $highestSession,
                    'date' => $highestSession ? $highestSession->finished_at : null
                ];
            }
        }

        // Sort leaderboard by score descending, then by date ascending (who achieved it first)
        usort($leaderboard, function ($a, $b) {
            if ($b['score'] === $a['score']) {
                return $a['date'] <=> $b['date'];
            }
            return $b['score'] <=> $a['score'];
        });

        // Split into top 3 (podium) and others (rank 4+)
        $top3 = array_slice($leaderboard, 0, 3);
        $others = array_slice($leaderboard, 3);

        return view('leaderboard.index', compact('top3', 'others'));
    }
}
