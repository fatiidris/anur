@extends('admin.frontend.layouts.layout')

@section('content')
<section class="sub-header" style="margin-bottom: 20px;">
    <h1 style="margin: 0;">Our Updates</h1>
</section>

<div class="container">
    <div class="page-content">

        <!-- Introductory Write-up -->
        <div class=gallery-description>
            <h2>
                Capturing Our School Moments
            </h2>
            <p>
                Take a look at some of our exciting events and memorable moments.  
                Each photo showcases our students’ creativity, dedication, and active participation in both academic and community activities.
            </p>
        </div>

        <!-- Updates Gallery -->
        <div class="gallery">
            <img src="{{ url('public/frontend/Img/image1.jpg') }}" alt="Cultural Day Celebration">
            <img src="{{ url('public/frontend/Img/image2.jpg') }}" alt="Science Exhibition Day">
            <img src="{{ url('public/frontend/Img/image3.jpg') }}" alt="Students on Excursion Trip">
            <img src="{{ url('public/frontend/Img/image9.jpg') }}" alt="Graduation Ceremony Highlights">
            <img src="{{ url('public/frontend/Img/image4.jpg') }}" alt="Community Outreach Programme">
        </div>

        <!-- Section Description Between Galleries -->
        <div class="gallery-description">
            <h3>
                Celebrating Achievements & Team Spirit
            </h3>
            <p>
                These snapshots capture moments of learning, leadership, and fun —  
                from classroom innovations to extracurricular events that inspire collaboration and excellence.
            </p>
        </div>

        <!-- Second Gallery Section -->
        <div class="gallery">
            <img src="{{ url('public/frontend/Img/image1.jpg') }}" alt="Classroom Innovation">
            <img src="{{ url('public/frontend/Img/image2.jpg') }}" alt="Staff Development Workshop">
            <img src="{{ url('public/frontend/Img/image3.jpg') }}" alt="Sports Day Event">
            <img src="{{ url('public/frontend/Img/image9.jpg') }}" alt="Award Presentation Ceremony">
            <img src="{{ url('public/frontend/Img/image4.jpg') }}" alt="Environmental Awareness Campaign">
        </div>

        <!-- Closing Write-up -->
        <div class="gallery-description">
            <h3>
                Our Journey Continues
            </h3>
            <p>
                We believe every event is an opportunity to learn and grow.  
                Stay tuned as we keep sharing stories that reflect our values, achievements, and community impact.
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
