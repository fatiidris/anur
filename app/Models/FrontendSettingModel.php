<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontendSettingModel extends Model
{
    use HasFactory;

    protected $table = 'frontend_settings';

    protected $fillable = [
        'address',
        'phone',
        'email',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'youtube_url',
        'about_us',
    ];

    public static function getSingle()
    {
        return self::firstOrNew([]);
    }
}