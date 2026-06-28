<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Mail\AutoReplyMail;
use App\Services\NotificationService;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.form');
    }

    public function send(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $contact = Contact::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        // 📩 Email admin
        Mail::to('contact@cursagesolutions.com')
            ->send(new ContactMail($contact));

        // 🤖 Auto réponse client
        Mail::to($contact->email)
            ->send(new AutoReplyMail($contact));

        // 🔔 Notification admin
        NotificationService::create(
            'Nouveau message contact',
            $contact->nom . ' a envoyé un message',
            'info',
            'contact'
        );

        return redirect()
            ->route('contact.form')
            ->with('success','Message envoyé avec succès.');
    }
}