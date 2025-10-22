<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontendSettingModel extends Model
{
    // use HasFactory; // Uncomment if you use factories

    protected $table = 'frontend_settings';

    protected $attributes = [
        'home_title' => '',
        'home_subtitle' => '',
        'about_title' => '',
        'about_description' => '',
        'about_image' => '',
        'carousel_title_1' => '',
        'carousel_text_1' => '',
        'carousel_image_1' => '',
         'carousel_title_2' => '', 
        'carousel_text_2' => '',   
        'carousel_image_2' => '', 
        
        'carousel_title_3' => '', 
        'carousel_text_3' => '',   
        'carousel_image_3' => '', 

        'carousel_title_4' => '', 
        'carousel_text_4' => '',   
        'carousel_image_4' => '', 
        'contact_title' => '',
        'cntact_image' => '',
    ];

    protected $fillable = [
        // Home/About Fields (Existing)
        'home_title',
        'home_subtitle',
        'about_title',
        'about_description',
        'about_image',

        // Carousel Fields (New)
        'carousel_title_1',
        'carousel_text_1',
        'carousel_image_1',
        'carousel_title_2',
        'carousel_text_2',
        'carousel_image_2',
        'carousel_title_3',
        'carousel_text_3',
        'carousel_image_3',
        'carousel_title_4',
        'carousel_text_4',
        'carousel_image_4',

        // Contact Fields (New)
        'contact_title',
        'cntact_image', // Note the database spelling: 'cntact_image'
    ];

    /**
     * Retrieves the single settings record.
     * @return FrontendSettingModel|null
     */
    static public function getSingle()
    {
        return self::first();
    }

    // ---------------------------------------------------------------------
    // IMAGE ACCESSOR METHODS
    // ---------------------------------------------------------------------

    /**
     * Accessor for the About section image URL.
     */
    public function getAboutImage()
    {
        if (!empty($this->about_image) && file_exists(public_path('upload/setting/' . $this->about_image))) {
            return url('upload/setting/' . $this->about_image);
        } else {
            return '';
        }
    }

    /**
     * Accessor for the Contact section image URL.
     */
    public function getContactImage()
    {
        // Note: The property name must match the database column name 'cntact_image'
        if (!empty($this->cntact_image) && file_exists(public_path('upload/setting/' . $this->cntact_image))) {
            return url('upload/setting/' . $this->cntact_image);
        } else {
            return '';
        }
    }
    
    // Accessors for Carousel Images 1 through 4
    
    public function getCarouselImage1()
    {
        if (!empty($this->carousel_image_1) && file_exists(public_path('upload/setting/' . $this->carousel_image_1))) {
            return url('upload/setting/' . $this->carousel_image_1);
        } else {
            return '';
        }
    }
    
    public function getCarouselImage2()
    {
        if (!empty($this->carousel_image_2) && file_exists(public_path('upload/setting/' . $this->carousel_image_2))) {
            return url('upload/setting/' . $this->carousel_image_2);
        } else {
            return '';
        }
    }
    
    public function getCarouselImage3()
    {
        if (!empty($this->carousel_image_3) && file_exists(public_path('upload/setting/' . $this->carousel_image_3))) {
            return url('upload/setting/' . $this->carousel_image_3);
        } else {
            return '';
        }
    }
    
    public function getCarouselImage4()
    {
        if (!empty($this->carousel_image_4) && file_exists(public_path('upload/setting/' . $this->carousel_image_4))) {
            return url('upload/setting/' . $this->carousel_image_4);
        } else {
            return '';
        }
    }

}