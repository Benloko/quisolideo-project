<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Partner;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function partners()
    {
        $partners = Partner::orderBy('created_at', 'desc')->get();
        return view('partners.index', compact('partners'));
    }

    public function boutique()
    {
        return view('boutique');
    }

    public function mentions()
    {
        return view('mentions');
    }

    public function politique()
    {
        return view('politique');
    }

    public function contact()
    {
        return view('contact');
    }

    public function contactSubmit(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:190',
            'message' => 'required|string|max:4000',
        ]);

        ContactMessage::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'message' => $data['message'],
            'read_flag' => false,
        ]);

        return redirect()
            ->route('contact')
            ->with('success', 'Merci, votre message a bien été envoyé. Nous revenons vers vous rapidement.');
    }
}
