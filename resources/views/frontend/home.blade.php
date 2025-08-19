@extends('frontend.layouts.layout')

@section('content')
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
				aria-current="true" aria-label="Slide 1"></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
				aria-label="Slide 2"></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
				aria-label="Slide 3"></button>
			<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
				aria-label="Slide 4"></button>
		</div>
        <div class="carousel-inner">
            <div class="carousel-item carousel-item1 active max-auto">
                <div class="carousel-text">
                    <h1>An-nur Model Islamic School</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                </div>
            </div>
            <div class="carousel-item carousel-item2">
                <div class="carousel-text">
                    <h1>An-nur Model Islamic School</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                </div>
            </div>
            <div class="carousel-item carousel-item3">
                <div class="carousel-text">
                    <h1>An-nur Model Islamic School</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                </div>
            </div>
            <div class="carousel-item carousel-item4">
                <div class="carousel-text">
                <h1>An-nur Model Islamic School</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
            </div>
            </div>
        </div>
    </div>

    <!-------- about us content -------->
    <div class="about-us">
		<div class="about-col">
			<h1>We are one of the top exellent schools</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            </p>
			<a href="" class="blue-btn">EXPLORE NOW</a>
		</div>
		<div class="about-col">

            <img src="{{ url ('public/frontend/Img/image3.jpg') }}" alt="Description of the image">
		</div>
    </div>
@endsection
