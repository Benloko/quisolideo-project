<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab') === 'programmes' ? 'programmes' : 'formations';

        $query = Training::query()->latest();

        if ($tab === 'programmes') {
            $query->where('slug', 'like', 'lime-eqd-%');
        } else {
            $query->where('slug', 'not like', 'lime-eqd-%');
        }

        $trainings = $query->take(50)->get();
        return view('trainings.index', compact('trainings', 'tab'));
    }

    public function show($slug)
    {
        $training = Training::where('slug', $slug)
            ->with(['images', 'videos'])
            ->firstOrFail();
        return view('trainings.show', compact('training'));
    }
}
