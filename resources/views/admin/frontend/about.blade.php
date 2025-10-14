@extends('admin.frontend.layouts.layout')

@section('content')
    <div class="container">
        <!-------- about us content -------->
<section class="sub-header">
    <h1>ABOUT US</h1>
</section>
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
			<img src="{{ url ('public/frontend/Img/image8.jpg')}}">
		</div>
</div>

<!-- ---------Sections--------- -->
<section class="classes">
	<h1>Sections We handle</h1>
	<p>We handle 3 sections which comprises of the Nursary section, Primary section and Secondary section</p>
</section>
    <div class="classes-row">
	<div class="classes-col">
		<h3>Nursary Section</h3>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor </p>
        	</div>
<div class="classes-col">
		<h3>Primray Section</h3>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor </p>
        	</div>
	<div class="classes-col">
		<h3>Secondary Section</h3>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor </p>
        	</div>
</div>

    </div>
@endsection
