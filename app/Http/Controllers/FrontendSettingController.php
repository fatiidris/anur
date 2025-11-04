<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FrontendSettingModel;
use App\Models\UpdatesSettingModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class FrontendSettingController extends Controller
{
    /**
     * Show the frontend settings page (admin).
     */
    public function FrontSetting()
    {
    
        $data['getRecord'] = FrontendSettingModel::getSingle() ?? new FrontendSettingModel();
        $data['header_title'] = "Frontend Setting";

        return view('admin.frontend.frontend_setting.settings', $data);
    }

        /**
         * Update or create the frontend setting.
         */
    public function UpdateFrontSetting(Request $request)
    {
        $setting = FrontendSettingModel::getSingle() ?? new FrontendSettingModel();

        // ====== TEXT FIELDS ======
        $setting->home_title = trim($request->home_title);
        $setting->home_subtitle = trim($request->home_subtitle);
        $setting->about_title = trim($request->about_title);
        $setting->about_description = trim($request->about_description);
        $setting->contact_title = trim($request->contact_title);

        // ====== CAROUSEL TITLES & TEXTS ======
        for ($i = 1; $i <= 4; $i++) {
            $setting->{'carousel_title_' . $i} = trim($request->{'carousel_title_' . $i});
            $setting->{'carousel_text_' . $i} = trim($request->{'carousel_text_' . $i});
        }

        // ====== IMAGE UPLOAD PATH ======
        $uploadPath = 'public/frontend/Img/';

        // ====== ABOUT IMAGE ======
        if (!empty($request->file('about_image'))) {
            $ext = $request->file('about_image')->getClientOriginalExtension();
            $file = $request->file('about_image');
            $randomStr = date('Ymdhis') . Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move($uploadPath, $filename);
            $setting->about_image = $filename;
        }

        // ====== CONTACT IMAGE ======
        if (!empty($request->file('contact_image'))) {
            $ext = $request->file('contact_image')->getClientOriginalExtension();
            $file = $request->file('contact_image');
            $randomStr = date('Ymdhis') . Str::random(10);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move($uploadPath, $filename);
            $setting->contact_image = $filename;
        }

        // ====== CAROUSEL IMAGES (1–4) ======
        for ($i = 1; $i <= 4; $i++) {
            $inputName = 'carousel_image_' . $i;
            if (!empty($request->file($inputName))) {
                $ext = $request->file($inputName)->getClientOriginalExtension();
                $file = $request->file($inputName);
                $randomStr = date('Ymdhis') . Str::random(10);
                $filename = strtolower($randomStr) . '.' . $ext;
                $file->move($uploadPath, $filename);
                $setting->$inputName = $filename;
            }
        }

        // ====== SAVE CHANGES ======
        $setting->save();

        return redirect()->back()->with('success', "Frontend Setting Successfully Updated");
    }

    public function UpdatesSetting()
    {
        // Fetch the first record (or empty if none exists yet)
          $setting = UpdatesSettingModel::first() ?? new UpdatesSettingModel();

        // Return your view (adjust the blade name if different)
        return view('admin.frontend.frontend_setting.update_setting', compact('setting'));
    }

    public function updateUpdatesSetting(Request $request)
    {
        // ✅ always use the first record (or create new)
        $setting = UpdatesSettingModel::first() ?? new UpdatesSettingModel();

        // Text fields
        $setting->update_intro_title = $request->update_intro_title;
        $setting->update_intro_description = $request->update_intro_description;
        $setting->update_middle_title = $request->update_middle_title;
        $setting->update_middle_description = $request->update_middle_description;
        $setting->update_footer_title = $request->update_footer_title;
        $setting->update_footer_description = $request->update_footer_description;

        // Image uploads
        for ($i = 1; $i <= 10; $i++) {
            $field = 'update_gallery_image_' . $i;
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . $i . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('public/frontend/Img'), $filename);
                $setting->$field = $filename;
            }
        }
        // dd($request->all());
        $setting->save();
        return redirect()->back()->with('success', 'Updates Page Settings Saved Successfully!');
    }
}
