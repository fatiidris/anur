@extends('admin.frontend.layouts.layout')

@section('content')
<section class="sub-header" style="margin-bottom: 20px;">
    {{-- This title is static, as it's not in your settings blade --}}
      <h1 style="margin: 0;">Our Updates</h1>
</section>

<div class="container">
        <div class="page-content">

              {{-- Use null-coalescing (??) to prevent errors if $setting is null --}}
       <div class=gallery-description>
            <h2>
              {{ $setting->update_intro_title ?? 'Capturing Our School Moments' }}
           </h2>
            <p>
              {{ $setting->update_intro_description ?? 'Take a look at some of our exciting events and memorable moments.' }}
            </p>
        </div>

           <div class="gallery">
            {{-- Loop through the first 5 gallery images --}}
            @for ($i = 1; $i <= 5; $i++)
                @php
                    // Create the dynamic property name
                    $imgKey = 'update_gallery_image_' . $i;
                    // Get the image filename, or null if it doesn't exist
                    $imgSrc = $setting->$imgKey ?? null;
                @endphp

                {{-- Only display the image tag if the image source is not empty --}}
                @if(!empty($imgSrc))
                    <img src="{{ url('public/frontend/Img/' . $imgSrc) }}" alt="Gallery Image {{ $i }}">
                @endif
            @endfor
            </div>

             <div class="gallery-description">
            <h3>
              {{ $setting->update_middle_title ?? 'Celebrating Achievements & Team Spirit' }}
           </h3>
            <p>
               {{ $setting->update_middle_description ?? 'These snapshots capture moments of learning, leadership, and fun.' }}
            </p>
           </div>

           <div class="gallery">
            {{-- Loop through the second set of 5 gallery images (6 to 10) --}}
            @for ($i = 6; $i <= 10; $i++)
                @php
                    $imgKey = 'update_gallery_image_' . $i;
                    $imgSrc = $setting->$imgKey ?? null;
                @endphp

                @if(!empty($imgSrc))
                    <img src="{{ url('public/frontend/Img/' . $imgSrc) }}" alt="Gallery Image {{ $i }}">
                @endif
            @endfor
           </div>

     <div class="gallery-description">
           <h3>
               {{ $setting->update_footer_title ?? 'Our Journey Continues' }}
           </h3>
              <p>
              {{ $setting->update_footer_description ?? 'We believe every event is an opportunity to learn and grow.' }}
            </p>
       </div>
    </div>
</div>

<style>
.gallery-description{
text-align: center;
font-family:"Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", Arial, sans-serif;
padding:20px;
}
.gallery-description p{
     font-size:20px;
}

 @media screen and (min-width: 285px) and (max-width: 1000px){
  .gallery {
         flex-direction: column;
   }
.gallery img {
      width: 100%;
      height: 100%;
      margin: 20px 0;
 }
}
</style>

@endsection