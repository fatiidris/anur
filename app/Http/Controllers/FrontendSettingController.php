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
    // dd($request->all());
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
        'contact_image' => $imageRules, // Corrected your comment, code was fine
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

    // Array of image fields to process: Model Property Name => Input Field Name
    $imageFields = [
        'about_image' => 'about_image',
        'contact_image' => 'contact_image',
        'carousel_image_1' => 'carousel_image_1',
        'carousel_image_2' => 'carousel_image_2',
        'carousel_image_3' => 'carousel_image_3',
        'carousel_image_4' => 'carousel_image_4',
    ];
    
    $uploadDirectory = 'public/frontend/Img/';

    // === START OF CORRECTION ===
    // This logic is now safer. We move the new file FIRST.
    // We only delete the old file AFTER the new one is moved.

    foreach ($imageFields as $modelProperty => $inputName) {
        
        // Use $request->hasFile() for a more reliable check
        if ($request->hasFile($inputName)) {

            // 1. Prepare the new file
            $file = $request->file($inputName);
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(10);
            $newFilename = strtolower($randomStr) . '.' . $ext;
            
            // 2. Get the old filename *before* updating the model
            $oldFilename = $setting->$modelProperty;

            // 3. Ensure the directory exists
            if (!File::exists(public_path($uploadDirectory))) {
                File::makeDirectory(public_path($uploadDirectory), 0755, true);
            }

            // 4. Move the new file. This is the part that can fail.
            $file->move(public_path($uploadDirectory), $newFilename);

            // 5. *After* the move is successful, update the model
            $setting->$modelProperty = $newFilename;

            // 6. *After* the model is updated, delete the old file
            if (!empty($oldFilename) && File::exists(public_path($uploadDirectory . $oldFilename))) {
                File::delete(public_path($uploadDirectory . $oldFilename));
            }
        }
    }
    // === END OF CORRECTION ===


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
                $file->move(public_path('public/frontend/Img'), $filename);
                $setting->$field = $filename;
            }
        }
        // dd($request->all());
        $setting->save();
        return redirect()->back()->with('success', 'Updates Page Settings Saved Successfully!');
    }
}
