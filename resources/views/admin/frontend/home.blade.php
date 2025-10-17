@extends('admin.frontend.layouts.layout')

@section('content') 

<!-- ====== CAROUSEL SECTION ====== -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @for ($i = 0; $i < 4; $i++)
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $i }}"
                class="{{ $i == 0 ? 'active' : '' }}" aria-current="{{ $i == 0 ? 'true' : 'false' }}"
                aria-label="Slide {{ $i + 1 }}"></button>
        @endfor
    </div>

    <div class="carousel-inner">
        @for ($i = 1; $i <= 4; $i++)
            @php
                $imageField = 'carousel_image_' . $i;
                $titleField = 'carousel_title_' . $i;
                $textField  = 'carousel_text_' . $i;

                // Load uploaded image or use a default fallback
                $imagePath = !empty($getSetting->$imageField)
                    ? url('public/frontend/Img/' . $getSetting->$imageField)
                    : url('public/frontend/Img/' . $i . '.jpg');
            @endphp

            <div class="carousel-item {{ $i == 1 ? 'active' : '' }}"
                style="background-image: url('{{ $imagePath }}');
                       background-size: cover;
                       background-position: center;
                       height: 550px;
                       position: relative;">
                <div class="carousel-text"
                    style="background-color: rgba(0,0,0,0.4);
                           color: #fff;
                           text-align: center;
                           padding-top: 200px;">
                    <h1>{{ $getSetting->$titleField ?? 'Default Carousel Title ' . $i }}</h1>
                    <p>{{ $getSetting->$textField ?? 'Default carousel text for slide ' . $i }}</p>
                </div>
            </div>
        @endfor
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- ====== HOME INTRO SECTION ====== -->
<section style="padding: 10px 20px; text-align: center;">
    <div class="container">
        <h1>{{ $getSetting->home_title ?? 'Default School Name' }}</h1>
        <p style="font-size: 18px; color: #555;">
            {{ $getSetting->home_subtitle ?? 'Default subtitle text here. Welcome to our school website!' }}
        </p>
    </div>
</section>

<!-- ====== ABOUT SECTION ====== -->
<section class="about-us">
    <div class="about-container">
        
        {{-- LEFT COLUMN: TEXT --}}
        <div class="about-text">
            <h1>{{ $getSetting->about_title ?? 'We are one of the top excellent schools' }}</h1>
            <p>
                {{ $getSetting->about_description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' }}
            </p>
            <a href="#" class="blue-btn">EXPLORE NOW</a>
        </div>

        {{-- RIGHT COLUMN: IMAGE --}}
        <div class="about-image">
            @php
                $aboutImage = !empty($getSetting->about_image)
                    ? url('public/frontend/Img/' . $getSetting->about_image)
                    : url('public/frontend/Img/image3.jpg');
            @endphp
            <img src="{{ $aboutImage }}" alt="About Image">
        </div>

    </div>
</section>

<style>
/* ABOUT SECTION LAYOUT */
.about-us {
    width: 100%;
    padding: 80px 5%;
    background-color: #fff;
    overflow: hidden; /* prevents overlap issues */
}

.about-container {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    gap: 40px;
    flex-wrap: wrap;
}

/* TEXT COLUMN */
.about-text {
    flex: 1 1 45%;
    min-width: 320px;
}

.about-text h1 {
    font-size: 2rem;
    margin-bottom: 20px;
}

.about-text p {
    font-size: 1rem;
    line-height: 1.8;
    margin-bottom: 25px;
}

.about-text .blue-btn {
    display: inline-block;
    background: #007bff;
    color: white;
    padding: 10px 25px;
    border-radius: 5px;
    text-decoration: none;
}

/* IMAGE COLUMN */
.about-image {
    flex: 1 1 45%;
    min-width: 320px;
    text-align: center;
}

.about-image img {
    width: 100%;
    max-width: 500px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* RESPONSIVE FIX */
@media (max-width: 768px) {
    .about-container {
        flex-direction: column;
        text-align: center;
    }
}
</style>


<!-- ====== CONTACT SECTION ====== -->
<section class="contact" style="margin-top: 80px; background-color: #f9f9f9; padding: 60px 20px;">
    <div class="container" style="text-align: center;">
        <h2>{{ $getSetting->contact_title ?? 'Get in Touch With Us' }}</h2>
        <div style="margin-top: 30px;">
            @php
                $contactImage = !empty($getSetting->cntact_image)
                    ? url('public/frontend/Img/' . $getSetting->cntact_image)
                    : url('public/frontend/Img/image4.jpg');
            @endphp
            <img src="{{ $contactImage }}" alt="Contact Image"
                style="width: 100%;
                       max-width: 500px;
                       border-radius: 10px;
                       box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
        </div>
    </div>
</section>

@endsection
