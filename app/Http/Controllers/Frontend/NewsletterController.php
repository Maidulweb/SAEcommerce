<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\MailHelper;
use App\Http\Controllers\Controller;
use App\Mail\SubscriptionVerification;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function newsletter(Request $request){
        $request->validate([
            'email' => ['email','required']
        ]);

        $subscriber = Newsletter::where('email', $request->email)->first();
        if(!empty($subscriber)){
            if($subscriber->is_verified == 0){
                $subscriber->token = \Str::random(25);
                $subscriber->save();
                 // set mail config
                 MailHelper::setMailConfig();
                 // send mail
                 Mail::to($subscriber->email)->send(new SubscriptionVerification($subscriber));

                 return response([
                    'alert-type' => 'success',
                    'message' => 'Email sent. Please check your email'
                 ]);
            }elseif($subscriber->is_verified == 1){
                 return response([
                    'alert-type' => 'error',
                    'message' => 'You already subscribed!!!'
                 ]);
            }
        }else{
            $subscriber = new Newsletter();

            $subscriber->email = $request->email;
            $subscriber->token = \Str::random(25);
            $subscriber->is_verified = 0;
            $subscriber->save();

            // set mail config
            MailHelper::setMailConfig();
            // send mail
            Mail::to($subscriber->email)->send(new SubscriptionVerification($subscriber));

            return response([
                'alert-type' => 'success',
                'message' => 'Email sent. Please check your email'
             ]);
        }
    }

    public function newsLetterEmailVarify($token){
        $verify = Newsletter::where('token', $token)->first();

        if($verify){
            $verify->token = 'verified';
            $verify->is_verified = 1;
            $verify->save();
            
            return redirect()->route('home')->with([
                'alert-type' => 'success',
                'message' => 'Email verification successfully'
            ]);
       }else {
            return redirect()->route('home')->with([
                'alert-type' => 'error',
                'message' => 'Invalid token'
            ]);
       }
    }
}
