<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Test Sessions Flow
    Route::post('/test/start', [TestController::class, 'start'])->name('test.start');
    
    // Listening Section
    Route::get('/test/{session}/listening', [TestController::class, 'listening'])->name('test.listening');
    Route::post('/test/{session}/listening', [TestController::class, 'submitListening'])->name('test.listening.submit');
    Route::post('/test/{session}/listening/play', [TestController::class, 'markAudioAsPlayed'])->name('test.listening.play');
    
    // Structure Section
    Route::get('/test/{session}/structure', [TestController::class, 'structure'])->name('test.structure');
    Route::post('/test/{session}/structure', [TestController::class, 'submitStructure'])->name('test.structure.submit');
    
    // Reading Section
    Route::get('/test/{session}/reading', [TestController::class, 'reading'])->name('test.reading');
    Route::post('/test/{session}/reading', [TestController::class, 'submitReading'])->name('test.reading.submit');
    
    // Results & Reviews
    Route::get('/test/{session}/result', [ResultController::class, 'show'])->name('test.result');
    Route::get('/test/{session}/review', [ResultController::class, 'review'])->name('test.review');

    // Materials
    Route::get('/materi', [MaterialController::class, 'index'])->name('material.index');
    Route::get('/materi/{slug}', [MaterialController::class, 'show'])->name('material.show');

    // Games
    Route::get('/game', [GameController::class, 'index'])->name('game.index');

    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
