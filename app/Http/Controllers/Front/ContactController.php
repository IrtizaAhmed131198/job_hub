<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function contact()
    {
        return view('front.contact');
    }

    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => [
                'required',
                'regex:/^(\+?\d{1,4}[\s-]?)?(\(?\d{1,4}\)?[\s-]?)?[\d\s-]{7,15}$/',
            ],
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }

        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        // Send email
        Mail::to('irtizaahmed32@gmail.com')->send(new ContactFormMail($details));

        return back()->with('success', 'Message sent successfully!');
    }
}
