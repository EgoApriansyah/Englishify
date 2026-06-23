<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestSession;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Passage;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    /**
     * Display the test results and score estimation.
     */
    public function show($sessionId)
    {
        $session = TestSession::where('id', $sessionId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // If not finished, redirect to the appropriate test section
        if (is_null($session->finished_at)) {
            return redirect()->route('test.' . $session->current_section, $session->id);
        }

        // Calculate correct answers per section
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

        // Convert using the given formula
        $listeningRaw = $correctListening;
        $structureRaw = $correctStructure;
        $readingRaw   = $correctReading;

        // Scaled score (linear approximation, scale 31–68)
        $listeningScaled  = round(31 + ($listeningRaw / 18) * 37);
        $structureScaled  = round(31 + ($structureRaw / 20) * 37);
        $readingScaled    = round(31 + ($readingRaw   / 35) * 37);

        // Total TOEFL ITP score (scale 310–677)
        $totalScore = round((($listeningScaled + $structureScaled + $readingScaled) / 3) * 10);

        return view('test.result', compact(
            'session',
            'listeningRaw',
            'structureRaw',
            'readingRaw',
            'listeningScaled',
            'structureScaled',
            'readingScaled',
            'totalScore'
        ));
    }

    /**
     * Review the questions and user's answers.
     */
    public function review($sessionId)
    {
        $session = TestSession::where('id', $sessionId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // If not finished, redirect
        if (is_null($session->finished_at)) {
            return redirect()->route('test.' . $session->current_section, $session->id);
        }

        // Get all questions with user's answers
        $questions = Question::with(['passage', 'answers' => function ($query) use ($session) {
                $query->where('test_session_id', $session->id);
            }])
            ->orderBy('order_number')
            ->get();

        return view('test.review', compact('session', 'questions'));
    }
}
