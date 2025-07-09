<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        // Validate the submitted email address
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        // Save the email to the database
        Newsletter::create([
            'email' => $request->email
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}
