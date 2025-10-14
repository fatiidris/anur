<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FrontendSettingModel;

class FrontendSettingController extends Controller
{
    public function settings()
    {
        $data['getRecord'] = FrontendSettingModel::getSingle();
        $data['header_title'] = "Frontend Settings";
        return view('admin.frontend_setting.settings', $data);
    }

    public function update(Request $request)
    {
        $settings = FrontendSettingModel::getSingle();
        $settings->address = trim($request->address);
        $settings->phone = trim($request->phone);
        $settings->email = trim($request->email);
        $settings->facebook_url = trim($request->facebook_url);
        $settings->twitter_url = trim($request->twitter_url);
        $settings->linkedin_url = trim($request->linkedin_url);
        $settings->youtube_url = trim($request->youtube_url);
        $settings->about_us = trim($request->about_us);
        $settings->save();

        return redirect()->back()->with('success', 'Frontend settings updated successfully.');
    }
}