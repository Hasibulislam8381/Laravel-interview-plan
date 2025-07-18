<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendContactEmail;

class ContactController extends Controller
{
    
    public function send(Request $request)
{
    $data = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'message' => 'required',
    ]);

    SendContactEmail::dispatch($data);

    return back()->with('success', 'Your message has been sent!');
}
}
