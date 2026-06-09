<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function index()
    {
        return view('emails.contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'nom' => ['required'],
            'email' => ['required','email'],
            'message' => ['required'],
        ]);

        $contact = Contact::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        Mail::to('contact@cursagesolutions.com')
            ->send(new ContactMail($contact));

        return redirect()
                ->route('contact.form')
                ->with('success','Message envoyé avec succès.');
    }
}