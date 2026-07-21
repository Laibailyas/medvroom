<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email',
            'subject'    => 'required|string|max:200',
            'message'    => 'required|string',
        ]);

Mail::to('laibailyas416@gmail.com')->send(new \App\Mail\ContactMail($request->all()));

        return back()->with('success', 'Your message has been sent! We\'ll get back to you within 24 hours.');
    }
}