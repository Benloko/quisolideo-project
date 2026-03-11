<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;

class AdminTrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::orderBy('created_at','desc')->get();
        return view('admin.trainings.index', compact('trainings'));
    }

    public function create()
    {
        return view('admin.trainings.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=>'required|string|max:255',
            'slug'=>'required|string|max:255|unique:trainings,slug',
            'short_description'=>'nullable|string',
            'content'=>'nullable|string',
            'image'=>'nullable|string',
            'seats'=>'nullable|integer',
            'price'=>'nullable|numeric',
        ]);

        Training::create($data);
        return redirect()->route('admin.trainings.index')->with('success','Formation créée');
    }

    public function edit(Training $training)
    {
        return view('admin.trainings.edit', compact('training'));
    }

    public function update(Request $request, Training $training)
    {
        $data = $request->validate([
            'title'=>'required|string|max:255',
            'slug'=>'required|string|max:255|unique:trainings,slug,'.$training->id,
            'short_description'=>'nullable|string',
            'content'=>'nullable|string',
            'image'=>'nullable|string',
            'seats'=>'nullable|integer',
            'price'=>'nullable|numeric',
        ]);
        $training->update($data);
        return redirect()->route('admin.trainings.index')->with('success','Formation mise à jour');
    }

    public function destroy(Training $training)
    {
        $training->delete();
        return redirect()->route('admin.trainings.index')->with('success','Formation supprimée');
    }
}
