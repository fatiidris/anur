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
    // The getSingle() method returns the first record or null.
    // We use the null coalescing operator (??) to provide a new
    // empty model instance if getSingle() returns null.
    $data['getRecord'] = FrontendSettingModel::getSingle() ?? new FrontendSettingModel();
    $data['header_title'] = "Frontend Setting";

    return view('admin.frontend.frontend_setting.settings', $data);
}

    /**
     * Update or create the frontend setting.
     */
    public function UpdateFrontSetting(Request $request)
    {
        // Define common validation rules for text and image fields
        $textRules = 'nullable|string';
        $titleRules = 'nullable|string|max:255';
        $imageRules = 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048';

        // Base validation rules
        $rules = [
            'home_title' => $titleRules,
            'home_subtitle' => $titleRules,
            'about_title' => $textRules,
            'about_description' => $textRules,
            'about_image' => $imageRules,
            'contact_title' => $textRules,
            'cntact_image' => $imageRules, // Note the spelling: 'cntact_image'
        ];

        // Add validation rules for the 4 carousel items dynamically
        for ($i = 1; $i <= 4; $i++) {
            $rules["carousel_title_$i"] = $titleRules;
            $rules["carousel_text_$i"] = $textRules;
            $rules["carousel_image_$i"] = $imageRules;
        }

        $request->validate($rules);

        // Get the existing record or create a new model instance
        $setting = FrontendSettingModel::getSingle() ?? new FrontendSettingModel();

        // ---------------------------------------------------------------------
        // 1. FILL TEXT FIELDS
        // ---------------------------------------------------------------------

        // Home/About/Contact text fields
        $setting->home_title = trim($request->input('home_title', ''));
        $setting->home_subtitle = trim($request->input('home_subtitle', ''));
        $setting->about_title = trim($request->input('about_title', ''));
        $setting->about_description = trim($request->input('about_description', ''));
        $setting->contact_title = trim($request->input('contact_title', ''));

        // Carousel text fields (Loop 1-4)
        for ($i = 1; $i <= 4; $i++) {
            $setting->{"carousel_title_$i"} = trim($request->input("carousel_title_$i", ''));
            $setting->{"carousel_text_$i"} = trim($request->input("carousel_text_$i", ''));
        }

        // ---------------------------------------------------------------------
        // 2. HANDLE IMAGE UPLOADS
        // ---------------------------------------------------------------------

        // Array of image fields to process: Model Property Name => Input Field Name
        $imageFields = [
            'about_image' => 'about_image',
            'cntact_image' => 'cntact_image',
            'carousel_image_1' => 'carousel_image_1',
            'carousel_image_2' => 'carousel_image_2',
            'carousel_image_3' => 'carousel_image_3',
            'carousel_image_4' => 'carousel_image_4',
        ];
        
        $uploadDirectory = 'frontend/Img/';

        foreach ($imageFields as $modelProperty => $inputName) {
            if (!empty($request->file($inputName))) {
                if (!empty($setting->$modelProperty) && File::exists(public_path($uploadDirectory . $setting->$modelProperty))) {
                    File::delete(public_path($uploadDirectory . $setting->$modelProperty));
                }

                if (!File::exists(public_path($uploadDirectory))) {
                    File::makeDirectory(public_path($uploadDirectory), 0755, true);
                }

                $file = $request->file($inputName);
                $ext = $file->getClientOriginalExtension();
                $randomStr = date('Ymdhis') . Str::random(10);
                $filename = strtolower($randomStr) . '.' . $ext;

                $file->move(public_path($uploadDirectory), $filename);
                $setting->$modelProperty = $filename;
            }
        }


        
        // ---------------------------------------------------------------------
        // 3. SAVE
        // ---------------------------------------------------------------------
        // dd($setting->getAttributes());
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
                $file->move(public_path('frontend/Img'), $filename);
                $setting->$field = $filename;
            }
        }
        // dd($request->all());
        $setting->save();
        return redirect()->back()->with('success', 'Updates Page Settings Saved Successfully!');
    }
}
