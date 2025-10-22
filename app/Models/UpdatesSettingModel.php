<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpdatesSettingModel extends Model
{
    protected $table = 'updates_settings';

    protected $fillable = [
        'update_intro_title',
        'update_intro_description',
        'update_middle_title',
        'update_middle_description',
        'update_footer_title',
        'update_footer_description',
        'update_gallery_image_1',
        'update_gallery_image_2',
        'update_gallery_image_3',
        'update_gallery_image_4',
        'update_gallery_image_5',
        'update_gallery_image_6',
        'update_gallery_image_7',
        'update_gallery_image_8',
        'update_gallery_image_9',
        'update_gallery_image_10',
    ];
}
