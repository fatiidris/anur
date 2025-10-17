@extends('admin.frontend.layouts.layout')

@section('content')
<div class="container">
    <!-------- about us content -------->
    <section class="sub-header">
        <h1>ABOUT US</h1>
    </section>

    <div class="page-content">
        <div class="about-us">
            <div class="about-col">
                <h1>We are one of the top excellent schools</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua. Ipsum dolor sit amet, consectetur
                    adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <a href="" class="blue-btn">EXPLORE NOW</a>
            </div>
            <div class="about-col">
                <img src="{{ url('public/frontend/Img/image8.jpg') }}" alt="About Us">
            </div>
        </div>

        <!-- ====== New Attractive Section (Values / Achievements) ====== -->
        <section class="values">
            <h1>Why Parents & Students Choose Us</h1>
            <p>We go beyond teaching — we nurture excellence, discipline, and innovation.</p>
            <div class="values-row">
                <div class="values-col">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <h3>Qualified Teachers</h3>
                    <p>Our teachers are highly trained and dedicated to bringing out the best in every learner.</p>
                </div>

                <div class="values-col">
                    <i class="fa-solid fa-lightbulb"></i>
                    <h3>Innovative Learning</h3>
                    <p>We integrate creativity and technology to make learning fun, engaging, and practical.</p>
                </div>

                <div class="values-col">
                    <i class="fa-solid fa-school"></i>
                    <h3>Conducive Environment</h3>
                    <p>We provide a safe, clean, and supportive environment that fosters academic growth.</p>
                </div>
            </div>
        </section>

        <!-- ---------Sections--------- -->
        <section class="classes">
            <h1>Sections We Handle</h1>
            <p>We handle 3 sections which comprise the Nursery section, Primary section, and Secondary section.</p>
        </section>

        <div class="classes-row">
            <div class="classes-col">
                <h3>Nursery Section</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua.</p>
            </div>

            <div class="classes-col">
                <h3>Primary Section</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua.</p>
            </div>

            <div class="classes-col">
                <h3>Secondary Section</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua.</p>
            </div>
        </div>
    </div>
</div>

<!-- ====== Styling for New Section ====== -->
<style>
    .values {
        text-align: center;
        margin: 60px 0;
    }

    .values h1 {
        font-size: 2rem;
        color: #003366;
        margin-bottom: 10px;
    }

    .values p {
        color: #555;
        font-size: 16px;
        margin-bottom: 40px;
    }

    .values-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 30px;
    }

    .values-col {
        flex: 1 1 250px;
        background: #f9f9f9;
        padding: 30px;
        border-radius: 15px;
        text-align: center;
        transition: 0.3s ease-in-out;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .values-col:hover {
        background: #003366;
        color: #fff;
        transform: translateY(-5px);
    }

    .values-col i {
        font-size: 40px;
        color: #007bff;
        margin-bottom: 15px;
    }

    .values-col h3 {
        font-size: 20px;
        margin-bottom: 10px;
        color: #222;
    }

    .values-col p {
        font-size: 15px;
        color: #666;
    }

    .values-col:hover i,
    .values-col:hover h3,
    .values-col:hover p {
        color: #fff;
    }
</style>
@endsection
