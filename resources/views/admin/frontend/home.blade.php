@extends('admin.frontend.layouts.layout')

@section('content')

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

    <div class="carousel-indicators">
        @for($i = 0; $i < 4; $i++)
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $i }}"
                class="{{ $i == 0 ? 'active' : '' }}" aria-current="{{ $i == 0 ? 'true' : 'false' }}"
                aria-label="Slide {{ $i + 1 }}">
            </button>
        @endfor
    </div>

    <div class="carousel-inner">
    @for($i = 1; $i <= 4; $i++)
        @php
            $carouselImage = !empty($getSetting->{"carousel_image_$i"})
                ? url('public/frontend/Img/' . $getSetting->{"carousel_image_$i"})
                : url('public/frontend/Img/image1.jpg');
        @endphp

        <div class="carousel-item carousel-item{{ $i }} {{ $i == 1 ? 'active' : '' }}" 
             style="background-image: url('{{ $carouselImage }}'); background-size: cover; background-position: center;">
            <div class="carousel-text">
                <h1>{{ $getSetting->{"carousel_title_$i"} }}</h1>
                <p>{{ $getSetting->{"carousel_text_$i"} }}</p>
            </div>
        </div>
    @endfor
</div>

</div>

<div class="about-us">
    <div class="about-col">
        <h1>{{ $getSetting->about_title }}</h1>
        <p>{{ $getSetting->about_description }}</p>
        <a href="" class="blue-btn">EXPLORE NOW</a>
    </div>

    @php
        $aboutImage = !empty($getSetting->about_image)
            ? url('public/frontend/Img/' . $getSetting->about_image)
            : url('public/frontend/Img/image3.jpg');
    @endphp
    <img src="{{ $aboutImage }}" alt="About Image" class="img-fluid">
</div>
@endsection
