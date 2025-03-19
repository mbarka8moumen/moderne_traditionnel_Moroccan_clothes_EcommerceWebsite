<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller {
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:1000',
        ]);

        ContactMessage::create($request->all());

        return redirect()->route('contact')->with('success', 'Merci ! Votre message a été envoyé avec succès. Nous vous contacterons bientôt.');
    }
}
