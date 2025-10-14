<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FrontendSettingModel;

class FrontendController extends Controller
{
    public function home()
    {
        $data['getRecord'] = FrontendSettingModel::getSingle();
        return view('frontend.home', $data);
    }

    public function about()
    {
        $data['getRecord'] = FrontendSettingModel::getSingle();
        return view('frontend.about', $data);
    }

    public function admission()
    {
        $data['getRecord'] = FrontendSettingModel::getSingle();
        return view('frontend.admission', $data);
    }

    public function contact()
    {
        $data['getRecord'] = FrontendSettingModel::getSingle();
        return view('frontend.contact', $data);
    }

    public function updates()
    {
        $data['getRecord'] = FrontendSettingModel::getSingle();
        return view('frontend.updates', $data);
    }

    public function results()
    {
        $data['getRecord'] = FrontendSettingModel::getSingle();
        return view('frontend.results', $data);
    }
}
