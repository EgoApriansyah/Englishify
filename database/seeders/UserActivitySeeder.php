<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TestSession;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            ['name' => 'Ahmad Maulana', 'email' => 'ahmad@example.com', 'correct_rate' => 0.85],
            ['name' => 'Dina Nurdiana', 'email' => 'dina@example.com', 'correct_rate' => 0.72],
            ['name' => 'Budi Pradipta', 'email' => 'budi@example.com', 'correct_rate' => 0.65],
            ['name' => 'Riana Indah', 'email' => 'riana@example.com', 'correct_rate' => 0.58],
            ['name' => 'Farhan Saputra', 'email' => 'farhan@example.com', 'correct_rate' => 0.50],
            ['name' => 'Siti Aminah', 'email' => 'siti@example.com', 'correct_rate' => 0.45],
        ];

        $questions = Question::all();

        if ($questions->isEmpty()) {
            return;
        }

        foreach ($students as $data) {
            // Create user
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'role' => 'student',
            ]);

            // Create 1 completed test session
            $session = TestSession::create([
                'user_id' => $user->id,
                'started_at' => now()->subDays(rand(1, 5)),
                'finished_at' => now()->subDays(rand(1, 5))->addMinutes(120),
                'current_section' => 'finished',
            ]);

            // Add answers
            $correctCount = 0;
            foreach ($questions as $q) {
                $isCorrect = (mt_rand(1, 100) <= ($data['correct_rate'] * 100));
                if ($isCorrect) {
                    $correctCount++;
                }
                
                // Select a random option
                $options = ['A', 'B', 'C', 'D'];
                $selected = $isCorrect ? $q->correct_option : $options[array_rand(array_diff($options, [$q->correct_option]))];

                Answer::create([
                    'test_session_id' => $session->id,
                    'question_id' => $q->id,
                    'selected_answer' => $selected,
                    'is_correct' => $isCorrect,
                ]);
            }

            // Update user XP
            $user->update(['xp' => $correctCount * 10]);
        }
    }
}
