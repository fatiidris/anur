<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        return view('frontend.home');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function admission()
    {
        return view('frontend.admission');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function updates()
    {
        return view('frontend.updates');
    }

    public function results()
    {
        return view('frontend.results');
    }
}
