<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMassage; // Assuming your model is named ContactMessage

class ContactController extends Controller
{
    /**
     * Show the contact form
     */
    public function index()
    {
        return view('page.contact');
    }

    /**
     * Handle contact form submission
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        // Create and save the message
        $message = ContactMassage::create($validated);

        // Optional: Send email notification
        // Mail::to('contact@coverinsight.com')->send(new ContactFormSubmitted($message));

        return redirect()->route('contact')
            ->with('success', 'Thank you for your message! Our insurance experts will respond within 24 hours.');
    }
}
