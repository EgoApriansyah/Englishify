<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        // --- DYNAMIC CARDS STATISTICS (NON-GIMMICK) ---
        
        // 1. XP Hari Ini (Today's XP)
        $todayXp = 0;
        $todaySessions = $user->testSessions()
            ->whereNotNull('finished_at')
            ->whereDate('finished_at', today())
            ->get();
        foreach ($todaySessions as $session) {
            $correctCount = $session->answers()->where('is_correct', true)->count();
            $todayXp += $correctCount * 10;
        }
        $todayXpPercentage = min(100, round(($todayXp / 500) * 100));

        // 2. Soal Selesai (Completed Questions)
        $allUserSessions = $user->testSessions()->get();
        $totalQuestionsAnswered = 0;
        $totalCorrectAnswers = 0;
        $answeredThisWeek = 0;
        $accuracy = 0;
        $highestSectionText = "Belum ada data tes";

        if ($allUserSessions->isNotEmpty()) {
            $allSessionIds = $allUserSessions->pluck('id');
            $totalQuestionsAnswered = \App\Models\Answer::whereIn('test_session_id', $allSessionIds)->count();
            $totalCorrectAnswers = \App\Models\Answer::whereIn('test_session_id', $allSessionIds)->where('is_correct', true)->count();
            
            $answeredThisWeek = \App\Models\Answer::whereIn('test_session_id', $allSessionIds)
                ->where('created_at', '>=', now()->subDays(7))
                ->count();
            
            if ($totalQuestionsAnswered > 0) {
                $accuracy = round(($totalCorrectAnswers / $totalQuestionsAnswered) * 100);

                // Calculate accuracy per section
                $sections = ['listening', 'structure', 'reading'];
                $sectionStats = [];
                foreach ($sections as $sec) {
                    $secTotal = \App\Models\Answer::whereIn('test_session_id', $allSessionIds)
                        ->whereHas('question', function ($q) use ($sec) {
                            $q->where('section', $sec);
                        })->count();
                    $secCorrect = \App\Models\Answer::whereIn('test_session_id', $allSessionIds)
                        ->whereHas('question', function ($q) use ($sec) {
                            $q->where('section', $sec);
                        })->where('is_correct', true)->count();
                    
                    $sectionStats[$sec] = $secTotal > 0 ? ($secCorrect / $secTotal) : 0;
                }

                arsort($sectionStats);
                $highestSec = key($sectionStats);
                $highestAcc = current($sectionStats);
                
                if ($highestAcc > 0) {
                    $highestSectionText = "Seksi " . ucfirst($highestSec) . " tertinggi (" . round($highestAcc * 100) . "%)";
                } else {
                    $highestSectionText = "Akurasi per bagian 0%";
                }
            }
        }

        // 3. League Ranking & Dynamic Leaderboard based on Total XP
        $allUsers = User::orderBy('xp', 'desc')->orderBy('id', 'asc')->get();
        
        $userXpList = [];
        $rank = 1;
        $currentUserRank = 1;
        foreach ($allUsers as $u) {
            $userXpList[$u->id] = [
                'user' => $u,
                'xp' => $u->xp,
                'rank' => $rank
            ];
            if ($u->id === $user->id) {
                $currentUserRank = $rank;
            }
            $rank++;
        }

        // Define League based on rank
        $leagueName = "Liga Perunggu";
        $leagueStatus = "Raih XP untuk naik liga";
        if ($currentUserRank <= 3) {
            $leagueName = "Liga Emas";
            $leagueStatus = "Aman dari zona degradasi";
        } elseif ($currentUserRank <= 10) {
            $leagueName = "Liga Perak";
            $leagueStatus = "Kesempatan naik ke Liga Emas";
        }

        // Get Top 5 users for sidebar leaderboard
        $sidebarLeaderboard = [];
        $rankCounter = 1;
        $userInTop5 = false;
        foreach ($userXpList as $uid => $data) {
            if ($rankCounter <= 5) {
                $sidebarLeaderboard[] = [
                    'rank' => $rankCounter,
                    'name' => $data['user']->name,
                    'xp' => $data['xp'],
                    'is_self' => ($uid === $user->id)
                ];
                if ($uid === $user->id) {
                    $userInTop5 = true;
                }
            }
            $rankCounter++;
        }

        // If current user is not in the top 5, append them at the bottom with a separator indicator
        if (!$userInTop5) {
            $sidebarLeaderboard[] = [
                'rank' => '...',
                'name' => '...',
                'xp' => '...',
                'is_self' => false,
                'is_separator' => true
            ];
            $sidebarLeaderboard[] = [
                'rank' => $currentUserRank,
                'name' => $user->name,
                'xp' => $user->xp,
                'is_self' => true
            ];
        }

        // 4. Learning Statistics (Last 30 Days) Chart Data
        $chartLabels = [];
        $chartData = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $label = now()->subDays($i)->format('d M');
            $chartLabels[] = $label;
            
            // Find test sessions completed on this day
            $daySessions = $user->testSessions()
                ->whereNotNull('finished_at')
                ->whereDate('finished_at', $date)
                ->get();
                
            $dayXp = 0;
            foreach ($daySessions as $session) {
                $correctCount = $session->answers()->where('is_correct', true)->count();
                $dayXp += $correctCount * 10;
            }
            $chartData[] = $dayXp;
        }

        return view('dashboard', compact(
            'user', 
            'sessions', 
            'lastScore', 
            'activeSession',
            'todayXp',
            'todayXpPercentage',
            'totalQuestionsAnswered',
            'answeredThisWeek',
            'accuracy',
            'highestSectionText',
            'currentUserRank',
            'leagueName',
            'leagueStatus',
            'sidebarLeaderboard',
            'chartLabels',
            'chartData'
        ));
    }
}
