<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestSession;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Passage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TestController extends Controller
{
    /**
     * Start a new test session or ask to resume/create new.
     */
    public function start(Request $request)
    {
        $user = Auth::user();

        // Check if there is an active (unfinished) session
        $activeSession = $user->testSessions()
            ->whereNull('finished_at')
            ->first();

        if ($activeSession) {
            // If user confirmed to resume
            if ($request->has('confirm_resume')) {
                return redirect()->route('test.' . $activeSession->current_section, $activeSession->id);
            }

            // If user confirmed to start a new test (deletes/cancels the old unfinished session)
            if ($request->has('confirm_new')) {
                $activeSession->delete();
                // continue to create new session below
            } else {
                // Show confirmation page/dialog
                return view('test.confirm_resume', compact('activeSession'));
            }
        }

        // Create new test session
        $session = TestSession::create([
            'user_id' => $user->id,
            'started_at' => Carbon::now(),
            'current_section' => 'listening',
        ]);

        return redirect()->route('test.listening', $session->id);
    }

    /**
     * Listening Comprehension Section
     */
    public function listening($sessionId)
    {
        $session = TestSession::where('id', $sessionId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Redirect to correct section if not listening
        if ($session->current_section === 'finished') {
            return redirect()->route('test.result', $session->id);
        }
        if ($session->current_section !== 'listening') {
            return redirect()->route('test.' . $session->current_section, $session->id);
        }

        // Set start time if not already set
        if (is_null($session->listening_started_at)) {
            $session->listening_started_at = Carbon::now();
            $session->save();
        }

        // Duration: 20 minutes (1200 seconds)
        $durationSeconds = 1200;
        $elapsedSeconds = Carbon::now()->diffInSeconds($session->listening_started_at);
        $timeLeft = max(0, $durationSeconds - $elapsedSeconds);

        // If time is already up, auto submit (or handle in view via JS auto submit)
        // Get all listening questions
        $questions = Question::where('section', 'listening')
            ->orderBy('order_number')
            ->get();

        // Get already saved answers
        $savedAnswers = Answer::where('test_session_id', $session->id)
            ->pluck('selected_answer', 'question_id')
            ->toArray();

        return view('test.listening', compact('session', 'questions', 'savedAnswers', 'timeLeft'));
    }

    /**
     * Submit Listening Section
     */
    public function submitListening(Request $request, $sessionId)
    {
        $session = TestSession::where('id', $sessionId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($session->current_section !== 'listening') {
            return redirect()->route('test.' . $session->current_section, $session->id);
        }

        // Save submitted answers
        $submittedAnswers = $request->input('answers', []);
        $questions = Question::where('section', 'listening')->get();

        foreach ($questions as $question) {
            $selectedAnswer = $submittedAnswers[$question->id] ?? null;
            $isCorrect = false;

            if ($selectedAnswer) {
                $isCorrect = (strtoupper($selectedAnswer) === strtoupper($question->correct_answer));
            }

            Answer::updateOrCreate(
                [
                    'test_session_id' => $session->id,
                    'question_id' => $question->id,
                ],
                [
                    'selected_answer' => $selectedAnswer,
                    'is_correct' => $isCorrect,
                ]
            );
        }

        // Move to structure
        $session->current_section = 'structure';
        $session->save();

        return redirect()->route('test.structure', $session->id);
    }

    /**
     * Structure & Written Expression Section
     */
    public function structure($sessionId)
    {
        $session = TestSession::where('id', $sessionId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Redirect if not structure
        if ($session->current_section === 'finished') {
            return redirect()->route('test.result', $session->id);
        }
        if ($session->current_section !== 'structure') {
            return redirect()->route('test.' . $session->current_section, $session->id);
        }

        // Set start time if not already set
        if (is_null($session->structure_started_at)) {
            $session->structure_started_at = Carbon::now();
            $session->save();
        }

        // Duration: 25 minutes (1500 seconds)
        $durationSeconds = 1500;
        $elapsedSeconds = Carbon::now()->diffInSeconds($session->structure_started_at);
        $timeLeft = max(0, $durationSeconds - $elapsedSeconds);

        // Get all structure questions
        $questions = Question::where('section', 'structure')
            ->orderBy('order_number')
            ->get();

        // Get already saved answers
        $savedAnswers = Answer::where('test_session_id', $session->id)
            ->pluck('selected_answer', 'question_id')
            ->toArray();

        return view('test.structure', compact('session', 'questions', 'savedAnswers', 'timeLeft'));
    }

    /**
     * Submit Structure Section
     */
    public function submitStructure(Request $request, $sessionId)
    {
        $session = TestSession::where('id', $sessionId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($session->current_section !== 'structure') {
            return redirect()->route('test.' . $session->current_section, $session->id);
        }

        // Save answers
        $submittedAnswers = $request->input('answers', []);
        $questions = Question::where('section', 'structure')->get();

        foreach ($questions as $question) {
            $selectedAnswer = $submittedAnswers[$question->id] ?? null;
            $isCorrect = false;

            if ($selectedAnswer) {
                $isCorrect = (strtoupper($selectedAnswer) === strtoupper($question->correct_answer));
            }

            Answer::updateOrCreate(
                [
                    'test_session_id' => $session->id,
                    'question_id' => $question->id,
                ],
                [
                    'selected_answer' => $selectedAnswer,
                    'is_correct' => $isCorrect,
                ]
            );
        }

        // Move to reading
        $session->current_section = 'reading';
        $session->save();

        return redirect()->route('test.reading', $session->id);
    }

    /**
     * Reading Comprehension Section
     */
    public function reading($sessionId)
    {
        $session = TestSession::where('id', $sessionId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Redirect if not reading
        if ($session->current_section === 'finished') {
            return redirect()->route('test.result', $session->id);
        }
        if ($session->current_section !== 'reading') {
            return redirect()->route('test.' . $session->current_section, $session->id);
        }

        // Set start time if not already set
        if (is_null($session->reading_started_at)) {
            $session->reading_started_at = Carbon::now();
            $session->save();
        }

        // Duration: 35 minutes (2100 seconds)
        $durationSeconds = 2100;
        $elapsedSeconds = Carbon::now()->diffInSeconds($session->reading_started_at);
        $timeLeft = max(0, $durationSeconds - $elapsedSeconds);

        // Get passages with their questions
        $passages = Passage::with(['questions' => function ($query) {
            $query->where('section', 'reading')->orderBy('order_number');
        }])->get();

        // In case there are questions without passages (should not happen, but just to be safe)
        $questions = Question::where('section', 'reading')
            ->orderBy('order_number')
            ->get();

        // Get already saved answers
        $savedAnswers = Answer::where('test_session_id', $session->id)
            ->pluck('selected_answer', 'question_id')
            ->toArray();

        return view('test.reading', compact('session', 'passages', 'questions', 'savedAnswers', 'timeLeft'));
    }

    /**
     * Submit Reading Section (Finish Test)
     */
    public function submitReading(Request $request, $sessionId)
    {
        $session = TestSession::where('id', $sessionId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($session->current_section !== 'reading') {
            return redirect()->route('test.' . $session->current_section, $session->id);
        }

        // Save answers
        $submittedAnswers = $request->input('answers', []);
        $questions = Question::where('section', 'reading')->get();

        foreach ($questions as $question) {
            $selectedAnswer = $submittedAnswers[$question->id] ?? null;
            $isCorrect = false;

            if ($selectedAnswer) {
                $isCorrect = (strtoupper($selectedAnswer) === strtoupper($question->correct_answer));
            }

            Answer::updateOrCreate(
                [
                    'test_session_id' => $session->id,
                    'question_id' => $question->id,
                ],
                [
                    'selected_answer' => $selectedAnswer,
                    'is_correct' => $isCorrect,
                ]
            );
        }

        // Mark test as finished
        $session->current_section = 'finished';
        $session->finished_at = Carbon::now();
        $session->save();

        return redirect()->route('test.result', $session->id);
    }
}
