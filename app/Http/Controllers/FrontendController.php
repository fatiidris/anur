<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FrontendSettingModel;

class FrontendController extends Controller
{
    public function home()
    {
        $getSetting = FrontendSettingModel::getSingle();
        // dd($getSetting);
        return view('admin.frontend.home', compact('getSetting'));
        
    }

    public function about()
    {
        $getSetting = FrontendSettingModel::getSingle();
        return view('admin.frontend.about');
    }

    public function admission()
    {
        return view('admin.frontend.admission');
    }

    public function contact()
    {
        return view('admin.frontend.contact');
    }
  public function sendContactEmail(Request $request)
    {
        // 1. Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // 2. Prepare and send the email
        // Make sure your .env file is configured for mail sending
        try {
            Mail::raw("Name: {$request->name}\nEmail: {$request->email}\n\nMessage:\n{$request->message}", function ($message) use ($request) {
                $message->to('your-email@example.com') // Replace with your email
                        ->subject($request->subject)
                        ->from($request->email, $request->name); // Reply-to email
            });

            // 3. Redirect with a success message
            return back()->with('success', 'Thank you for your message! We will get back to you shortly.');

        } catch (\Exception $e) {
            // 4. Redirect with an error message if something goes wrong
            return back()->with('error', 'There was an issue sending your message. Please try again later.');
        }
    }

    public function updates()
    {
        return view('admin.frontend.updates');
    }

    public function results()
    {
        return view('admin.frontend.results');
    }
}
