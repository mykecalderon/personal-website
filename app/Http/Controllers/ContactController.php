<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use App\Mail\ContactFormSubmitted;
use Illuminate\Http\Request;
use Mail;
use Log;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required',
        ]);

        $contact_submission = ContactSubmission::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        try {
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactFormSubmitted($contact_submission));
        }
        catch(\Exception $e) {
            Log::error('Could not send contact form submission email.', [
                'exception' => $e,
            ]);
        }

        return view('thank-you');
    }
}
