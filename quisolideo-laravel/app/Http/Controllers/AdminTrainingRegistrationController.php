<?php

namespace App\Http\Controllers;

use App\Models\TrainingRegistration;

class AdminTrainingRegistrationController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $trainingId = (string) $request->query('training_id', '');

        $registrations = TrainingRegistration::with('training')
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('first_name', 'like', '%' . $q . '%')
                        ->orWhere('last_name', 'like', '%' . $q . '%')
                        ->orWhere('email', 'like', '%' . $q . '%')
                        ->orWhere('phone', 'like', '%' . $q . '%');
                });
            })
            ->when($trainingId !== '', function ($query) use ($trainingId) {
                $query->where('training_id', (int) $trainingId);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $trainings = \App\Models\Training::orderBy('title')->get(['id', 'title']);

        return view('admin.registrations.index', compact('registrations', 'trainings'));
    }

    public function show(TrainingRegistration $registration)
    {
        $registration->load('training');

        return view('admin.registrations.show', compact('registration'));
    }

    public function destroy(TrainingRegistration $registration)
    {
        $registration->delete();

        return redirect()
            ->route('admin.registrations.index')
            ->with('success', 'Inscription supprimée.');
    }
}
