<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class TrainingRegistrationController extends Controller
{
    public function create(string $slug)
    {
        $training = Training::where('slug', $slug)->firstOrFail();

        return redirect()->route('trainings.show', [
            'slug' => $training->slug,
            'register' => 1,
        ]);
    }

    public function store(Request $request, string $slug)
    {
        $training = Training::where('slug', $slug)->firstOrFail();

        $data = $request->validateWithBag('trainingRegistration', [
            'first_name' => 'required|string|max:120',
            'last_name' => 'required|string|max:120',
            'email' => 'required|email|max:190',
            'education_level' => 'required|string|max:190',
            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:8192',
            'phone' => 'required|string|max:40',
            'message' => 'required|string|max:2000',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('trainings/registrations', 'public');
            $data['photo_path'] = '/storage/' . $path;
        }

        if ($request->hasFile('cv')) {
            $path = $request->file('cv')->store('trainings/registrations/cv', 'public');
            $data['cv_path'] = '/storage/' . $path;
        }

        unset($data['photo']);
        unset($data['cv']);

        $training->registrations()->create($data);

        return redirect()
            ->route('trainings.show', $training->slug)
            ->with('registration_success', 'Merci ! Nous avons bien reçu votre message. Nous vous recontactons rapidement par email (Gmail) ou WhatsApp — restez disponible sur les deux. Merci.');
    }
}
