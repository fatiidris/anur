@extends('frontend.layouts.layout')

@section('content')
    <div class="container">
        <section class="sub-header">
            <h1>Our Updates</h1>
        </section>

        <!-- Updates Gallery -->
        <div class="gallery">
            <img src="{{ url('public/frontend/Img/image1.jpg')}}" alt="">
            <img src="{{ url('public/frontend/Img/image2.jpg')}}" alt="">
            <img src="{{ url('public/frontend/Img/image3.jpg')}}" alt="">
            <img src="{{ url('public/frontend/Img/image9.jpg')}}" alt="">
            <img src="{{ url('public/frontend/Img/image4.jpg')}}" alt="">
        </div>
        <div class="gallery">
            <img src="{{ url('public/frontend/Img/image1.jpg')}}" alt="">
            <img src="{{ url('public/frontend/Img/image2.jpg')}}" alt="">
            <img src="{{ url('public/frontend/Img/image3.jpg')}}" alt="">
            <img src="{{ url('public/frontend/Img/image9.jpg')}}" alt="">
            <img src="{{ url('public/frontend/Img/image4.jpg')}}" alt="">
        </div>
    </div>
@endsection
