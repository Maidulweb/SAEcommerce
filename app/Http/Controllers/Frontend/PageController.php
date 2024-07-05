<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use App\Models\SmtpConfiguration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function contact(){
        return view('frontend.pages.contact');
    }

    public function handleContact(Request $request){
         $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
         ]);

         $config = SmtpConfiguration::first();
         Mail::to($config->email)->send(new Contact($request->subject, $request->message, $request->email));

         return response([
            'alert-type' => 'success',
            'status' => 'success',
            'message' => 'Message sent successfully'
         ]);

    }
}
