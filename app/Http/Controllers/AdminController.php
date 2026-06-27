<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TestSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Total students
        $totalStudents = User::where('role', 'student')->count();

        // Total finished test sessions
        $sessions = TestSession::whereNotNull('finished_at')->get();
        $totalCompletedTests = $sessions->count();

        // Average TOEFL Score and Chart Datasets
        $totalScoreSum = 0;
        $totalListeningSum = 0;
        $totalStructureSum = 0;
        $totalReadingSum = 0;

        $scoreDistribution = [
            'Under 400' => 0,
            '400 - 450' => 0,
            '451 - 500' => 0,
            '501 - 550' => 0,
            '551 - 600' => 0,
            'Above 600' => 0,
        ];

        $dailyData = [];

        foreach ($sessions as $session) {
            $correctListening = $session->answers()->whereHas('question', function ($q) { $q->where('section', 'listening'); })->where('is_correct', true)->count();
            $correctStructure = $session->answers()->whereHas('question', function ($q) { $q->where('section', 'structure'); })->where('is_correct', true)->count();
            $correctReading = $session->answers()->whereHas('question', function ($q) { $q->where('section', 'reading'); })->where('is_correct', true)->count();
            
            $listeningScaled  = round(31 + ($correctListening / 18) * 37);
            $structureScaled  = round(31 + ($correctStructure / 20) * 37);
            $readingScaled    = round(31 + ($correctReading / 35) * 37);
            
            $score = round((($listeningScaled + $structureScaled + $readingScaled) / 3) * 10);
            $totalScoreSum += $score;

            // Section sums (converted back to 310 - 680 scale)
            $totalListeningSum += $listeningScaled * 10;
            $totalStructureSum += $structureScaled * 10;
            $totalReadingSum += $readingScaled * 10;

            // Group into distribution buckets
            if ($score < 400) {
                $scoreDistribution['Under 400']++;
            } elseif ($score <= 450) {
                $scoreDistribution['400 - 450']++;
            } elseif ($score <= 500) {
                $scoreDistribution['451 - 500']++;
            } elseif ($score <= 550) {
                $scoreDistribution['501 - 550']++;
            } elseif ($score <= 600) {
                $scoreDistribution['551 - 600']++;
            } else {
                $scoreDistribution['Above 600']++;
            }

            // Group daily completions
            $date = $session->finished_at->format('Y-m-d');
            if (!isset($dailyData[$date])) {
                $dailyData[$date] = ['count' => 0, 'score_sum' => 0];
            }
            $dailyData[$date]['count']++;
            $dailyData[$date]['score_sum'] += $score;
        }

        $averageToeflScore = $totalCompletedTests > 0 ? round($totalScoreSum / $totalCompletedTests) : 0;
        
        $avgListening = $totalCompletedTests > 0 ? round($totalListeningSum / $totalCompletedTests) : 0;
        $avgStructure = $totalCompletedTests > 0 ? round($totalStructureSum / $totalCompletedTests) : 0;
        $avgReading = $totalCompletedTests > 0 ? round($totalReadingSum / $totalCompletedTests) : 0;

        $sectionPerformance = [
            'Listening' => $avgListening,
            'Structure' => $avgStructure,
            'Reading' => $avgReading,
        ];

        // Sort trend by date
        ksort($dailyData);
        $trendLabels = [];
        $trendCounts = [];
        $trendAvgScores = [];
        foreach ($dailyData as $date => $data) {
            $trendLabels[] = date('d M Y', strtotime($date));
            $trendCounts[] = $data['count'];
            $trendAvgScores[] = round($data['score_sum'] / $data['count']);
        }

        // Fetch all users sorted by role and creation date
        $users = User::orderBy('role', 'asc')->orderBy('created_at', 'desc')->get();

        return view('admin.index', compact(
            'totalStudents', 
            'totalCompletedTests', 
            'averageToeflScore', 
            'users',
            'scoreDistribution',
            'sectionPerformance',
            'trendLabels',
            'trendCounts',
            'trendAvgScores'
        ));
    }

    /**
     * Store a newly created user in storage.
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', 'in:student,admin'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Akun berhasil ditambahkan!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroyUser(User $user)
    {
        // Prevent deleting oneself
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.dashboard')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Akun berhasil dihapus!');
    }
}
