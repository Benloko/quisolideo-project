<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'newsletter_email' => 'required|email|max:190',
            ],
            [
                'newsletter_email.required' => 'Veuillez saisir une adresse email.',
                'newsletter_email.email' => 'Veuillez saisir une adresse email valide.',
            ]
        );

        $email = mb_strtolower(trim($data['newsletter_email']));

        NewsletterSubscriber::updateOrCreate(
            ['email' => $email],
            ['subscribed_at' => now(), 'unsubscribed_at' => null]
        );

        return back()->with('newsletter_success', 'Merci ! Votre inscription à la newsletter est confirmée.');
    }
}
