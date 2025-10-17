@extends('admin.frontend.layouts.layout')

@section('content')
<section class="sub-header" style="margin-bottom: 20px;">
    <h1 style="margin: 0;">Our Updates</h1>
</section>

<div class="container">
    <div class="page-content">

        <!-- Introductory Write-up -->
        <div class="update-intro" style="margin-bottom: 15px; text-align: center;">
            <h2 style="font-size: 22px; font-weight: 700; color: #222; margin-bottom: 5px;">
                Capturing Our School Moments
            </h2>
            <p style="font-size: 17px; font-weight: 600; color: #333; line-height: 1.6; max-width: 800px; margin: 0 auto;">
                Take a look at some of our exciting events and memorable moments.  
                Each photo showcases our students’ creativity, dedication, and active participation in both academic and community activities.
            </p>
        </div>

        <!-- Updates Gallery -->
        <div class="gallery" style="margin-bottom: 15px;">
            <img src="{{ url('public/frontend/Img/image1.jpg') }}" alt="Cultural Day Celebration">
            <img src="{{ url('public/frontend/Img/image2.jpg') }}" alt="Science Exhibition Day">
            <img src="{{ url('public/frontend/Img/image3.jpg') }}" alt="Students on Excursion Trip">
            <img src="{{ url('public/frontend/Img/image9.jpg') }}" alt="Graduation Ceremony Highlights">
            <img src="{{ url('public/frontend/Img/image4.jpg') }}" alt="Community Outreach Programme">
        </div>

        <!-- Section Description Between Galleries -->
        <div class="gallery-description" style="text-align: center; margin: 25px 0 15px;">
            <h3 style="font-size: 20px; font-weight: 700; color: #222; margin-bottom: 5px;">
                Celebrating Achievements & Team Spirit
            </h3>
            <p style="font-size: 16px; font-weight: 600; color: #444; max-width: 800px; margin: 0 auto; line-height: 1.6;">
                These snapshots capture moments of learning, leadership, and fun —  
                from classroom innovations to extracurricular events that inspire collaboration and excellence.
            </p>
        </div>

        <!-- Second Gallery Section -->
        <div class="gallery" style="margin-bottom: 15px;">
            <img src="{{ url('public/frontend/Img/image1.jpg') }}" alt="Classroom Innovation">
            <img src="{{ url('public/frontend/Img/image2.jpg') }}" alt="Staff Development Workshop">
            <img src="{{ url('public/frontend/Img/image3.jpg') }}" alt="Sports Day Event">
            <img src="{{ url('public/frontend/Img/image9.jpg') }}" alt="Award Presentation Ceremony">
            <img src="{{ url('public/frontend/Img/image4.jpg') }}" alt="Environmental Awareness Campaign">
        </div>

        <!-- Closing Write-up -->
        <div class="update-footer" style="margin-top: 25px; text-align: center;">
            <h3 style="font-size: 20px; font-weight: 700; color: #222; margin-bottom: 5px;">
                Our Journey Continues
            </h3>
            <p style="font-size: 17px; font-weight: 600; color: #333; line-height: 1.6; max-width: 800px; margin: 0 auto;">
                We believe every event is an opportunity to learn and grow.  
                Stay tuned as we keep sharing stories that reflect our values, achievements, and community impact.
            </p>
        </div>

    </div>
</div>
@endsection
