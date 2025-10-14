<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FrontendSettingModel;

class FrontendController extends Controller
{
    public function home()
    {
        $getSetting = FrontendSettingModel::getSingle();
        return view('admin.frontend.home');
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

    public function updates()
    {
        return view('frontend.updates');
    }

    public function results()
    {
        return view('admin.frontend.results');
    }
}
