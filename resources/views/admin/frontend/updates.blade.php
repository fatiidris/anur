@extends('admin.frontend.layouts.layout')

@section('content')
<section class="sub-header" style="margin-bottom: 20px;">
    <h1 style="margin: 0;">Our Updates</h1>
</section>

<div class="container">
    <div class="page-content">

        <!-- Introductory Write-up -->
        <div class="gallery-description">
            <h2>{{ $setting->update_intro_title ?? 'Capturing Our School Moments' }}</h2>
            <p>
                {{ $setting->update_intro_description ?? 'Take a look at some of our exciting events and memorable moments. Each photo showcases our students’ creativity, dedication, and active participation in both academic and community activities.' }}
            </p>
        </div>

        <!-- Updates Gallery -->
        <div class="gallery">
            @for($i = 1; $i <= 5; $i++)
                @php
                    $setting = $setting ?? \App\Models\UpdatesSettingModel::first();
                    $imageField = 'update_gallery_image_' . $i;
                    $imagePath = $setting->$imageField ? url('public/frontend/Img/' . $setting->$imageField) : null;
                @endphp

                @if($imagePath)
                    <img src="{{ $imagePath }}" alt="Gallery Image {{ $i }}">
                @endif
            @endfor
        </div>

        <!-- Section Description Between Galleries -->
        <div class="gallery-description">
            <h3>{{ $setting->update_middle_title ?? 'Celebrating Achievements & Team Spirit' }}</h3>
            <p>
                {{ $setting->update_middle_description ?? 'These snapshots capture moments of learning, leadership, and fun — from classroom innovations to extracurricular events that inspire collaboration and excellence.' }}
            </p>
        </div>

        <!-- Second Gallery Section -->
        <div class="gallery">
            @for($i = 6; $i <= 10; $i++)
                @php
                    $setting = $setting ?? \App\Models\UpdatesSettingModel::first();
                    $imageField = 'update_gallery_image_' . $i;
                    $imagePath = $setting->$imageField ? url('public/frontend/Img/' . $setting->$imageField) : null;
                @endphp

                @if($imagePath)
                    <img src="{{ $imagePath }}" alt="Gallery Image {{ $i }}">
                @endif
            @endfor
        </div>

        <!-- Closing Write-up -->
        <div class="gallery-description">
            <h3>{{ $setting->update_footer_title ?? 'Our Journey Continues' }}</h3>
            <p>
                {{ $setting->update_footer_description ?? 'We believe every event is an opportunity to learn and grow. Stay tuned as we keep sharing stories that reflect our values, achievements, and community impact.' }}
            </p>
        </div>

    </div>
</div>

<style>
.gallery-description {
    text-align: center;
    font-family: "Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", Arial, sans-serif;
    padding: 20px;
}
.gallery-description p {
    font-size: 20px;
}
.gallery {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
}
.gallery img {
    width: 200px;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
}
@media screen and (min-width: 285px) and (max-width: 1000px) {
    .gallery {
        flex-direction: column;
    }
    .gallery img {
        width: 100%;
        height: auto;
        margin: 20px 0;
    }
}
</style>

@endsection
