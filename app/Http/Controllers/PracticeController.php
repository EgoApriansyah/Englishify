<?php

namespace App\Http\Controllers;

use App\Models\PracticeVideo;
use Illuminate\Http\Request;

class PracticeController extends Controller
{
    /**
     * Display a listing of the practice videos.
     */
    public function index()
    {
        $videos = PracticeVideo::all();
        return view('practice.index', compact('videos'));
    }

    /**
     * Show the shadowing practice player for the specified video.
     */
    public function shadowing($id)
    {
        $video = PracticeVideo::findOrFail($id);
        return view('practice.shadowing', compact('video'));
    }

    /**
     * Show the dictation practice player for the specified video.
     */
    public function dictation($id)
    {
        $video = PracticeVideo::findOrFail($id);
        return view('practice.dictation', compact('video'));
    }
}
