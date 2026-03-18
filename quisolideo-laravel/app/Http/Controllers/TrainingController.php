<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::latest()->take(50)->get();
        return view('trainings.index', compact('trainings'));
    }

    public function show($slug)
    {
        $training = Training::where('slug', $slug)
            ->with(['images', 'videos'])
            ->firstOrFail();
        return view('trainings.show', compact('training'));
    }
}
