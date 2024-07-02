<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\NewsletterDataTable;
use App\Http\Controllers\Controller;
use App\Mail\Newsletter as MailNewsletter;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterSubscriberController extends Controller
{
    public function index(NewsletterDataTable $datatable){
      return $datatable->render('admin.newsletter-subscriber.index');
    }

    public function sendMail(Request $request){
        $request->validate([
          'subject' => 'required',
          'message' => 'required',
        ]);
        
        $subscribers = Newsletter::where('is_verified', 1)->pluck('email')->toArray();
        Mail::to($subscribers)->send(new MailNewsletter($request->subject, $request->message));

        return redirect()->back()->with([
            'alert-type' => 'success',
            'message' => 'Newsletter send successfully'
        ]);
    }

    public function destroy($id){
        $newsletter = Newsletter::findOrFail($id);
        $newsletter->delete();
        return response([
            'alert-type' => 'success',
            'status' => 'success',
            'message' => 'Delete'
        ]);
    }
}
