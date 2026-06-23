<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the learning materials.
     */
    public function index()
    {
        $materials = Material::orderBy('order_number')->get();

        return view('material.index', compact('materials'));
    }

    /**
     * Display the specified learning material.
     */
    public function show($slug)
    {
        $material = Material::where('slug', $slug)->firstOrFail();
        $allMaterials = Material::orderBy('order_number')->get();

        return view('material.show', compact('material', 'allMaterials'));
    }
}
