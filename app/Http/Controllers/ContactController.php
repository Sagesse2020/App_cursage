<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function index(Contact $contact)
    {
        return view('contact');
    }

    public function send(Request $request, Contact $contact)
    {
        $request->validate([
            'nom' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $contact = Contact::create($request->all());

        Mail::to('contact@cursagesolutions.com')
            ->send(new ContactMail($contact));

        return back()->with('success','Message envoyé');
    }
}