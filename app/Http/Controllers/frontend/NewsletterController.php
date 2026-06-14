<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if the email already exists
        $newsletter = Newsletter::where('email', $request->email)->first();

        if ($newsletter) {

            // Already subscribed
            if ($newsletter->is_subscribed) {
                return back()->with('error', 'You are already subscribed to our newsletter.');
            }

            // Previously unsubscribed, subscribe again
            $newsletter->is_subscribed = true;

            // Generate a token if it doesn't exist
            if (empty($newsletter->unsubscribe_token)) {
                $newsletter->unsubscribe_token = Str::random(64);
            }

            $newsletter->save();

            return back()->with('success', 'Welcome back! Your subscription has been reactivated.');
        }

        // New subscriber
        Newsletter::create([
            'email' => $request->email,
            'unsubscribe_token' => Str::random(64),
            'is_subscribed' => true,
        ]);

        return back()->with('success', 'Subscribed successfully!');
    }

    public function show()
    {
        $newsletter = Newsletter::where('is_subscribed', 1)->get();;
        return view('admin.newsletter.index',compact('newsletter'));
    }

    public function sendNewsletter(Request $request) 
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $subscribers = Newsletter::where('is_subscribed', 1)->get();

        foreach ($subscribers as $subscriber) {

            Mail::send(
                'Admin.newsletter.email',
                [
                    'subject' => $request->subject,
                    'messageBody' => $request->message,
                    'subscriber' => $subscriber,
                ],
                function ($mail) use ($subscriber, $request) {

                    $mail->to($subscriber->email)
                        ->subject($request->subject);

                }
            );

        }

        return back()->with('success', 'Newsletter sent successfully!');
    }

    public function unsubscribe($token)
    {
        $subscriber = Newsletter::where('unsubscribe_token', $token)->first();

        if (!$subscriber) {

            return view('Admin.newsletter.invalid');

        }

        $subscriber->is_subscribed = false;
        $subscriber->save();

        return view('Admin.newsletter.unsubscribe-success');
    }
}
