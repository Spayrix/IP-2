<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Formdan gelen verileri doğrula
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Veritabanına kaydet
        Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
        ]);

        return redirect()->route('contact')->with('success', 'Your message has been sent!');
    }
}
