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
             style="background: linear-gradient(rgba(31, 26, 26, 0.5), rgb(0, 0, 0, 0.5)), url('{{ $carouselImage }}'); background-size: cover; background-position: center;">
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

    <div class="about-col">
    @php
        $aboutImage = !empty($getSetting->about_image)
            ? url('public/frontend/Img/' . $getSetting->about_image)
            : url('public/frontend/Img/image3.jpg');
    @endphp
    <img src="{{ $aboutImage }}" alt="About Image" class="img-fluid">
</div>
</div>

<style>
.carousel-text {
  display: flex;
  flex-direction: column;
  margin: auto;
  margin-top: 30vh;
  color: white;
  width:50%;
  text-align:center;
}
.carousel-text h1{
    font-size:50px;
}
.carousel-text p{
    font-size:20px;
}
.c
.carousel-indicators [data-bs-target] {
  border-radius: 50% !important;
  width: 10px;
  height: 10px;
  transition: opacity 0.1s;
  background-color: white;
}
@media (max-width: 1000px) {
  .carousel-item1 {
    height: 100%;
    text-align: center;
  }
  .carousel-item2 {
    height: 100%;
    text-align: center;
  }
  .carousel-item3 {
    height: 100%;
    text-align: center;
  }
  .carousel-item4 {
    height: 100%;
    text-align: center;
  }
  .carousel-text {
    margin: 20vh 0 20vh 0;
  }
}

.about-us {
  width: 80%;
  display: flex;
  margin: auto;
  padding-top: 80px;
  padding-bottom: 50px;
  color: black;
  gap: 20px;
}
.about-col {
  flex-basis: 48%;
  padding: 30px 2px;
}
.about-col img {
  width: 100%;
}
.about-col h1 {
  padding-top: 0;
  color: black;
}
.about-col p {
  padding: 15px 0 25px;
}
.blue-btn {
  border: 1px solid #96bbe1;
  background: transparent;
  color: #96bbe1;
  padding: 8px 10px;
}
.blue-btn:hover {
  color: white;
}
@media (max-width: 1000px) {
  .sub-header {
    height: 20vh;
  }
  .about-us {
    flex-direction: column;
  }
}

</style>

@endsection
