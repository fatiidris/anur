<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ url ('public/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url ('public/frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url ('public/frontend/css/style.css') }}" />

    <title>An-nur</title>
  </head>
  <body>
    <body id="top">
        <div class="whole-container">
        <div class="header">
            <p>FAQs</p>
            <p>Support</p>
            <p>Help</p> 
            <div class="icons" style="float:right;">
                <a href="http://facbook.com/anur" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="http://x.com/anur" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                <a href="http://linkedin.com/anur" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="http://instagram.com/anur" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <a href="http://youtube.com.com" target="_blank"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
        <nav id="main-nav-wrap">
            <label>
            <img src="{{ url ('public/frontend/Img/image3.jpg') }}" alt="Description of the image">
               <div> 
                <h3>An-nur</h3>
                <p>Model School</p>
            </div>
            </label>
            <div class="nav-links" Id="checkmenu">
                <ul>
                    <i class="fa fa-times" onclick ="hideMenu()"></i>          
                <li class="current"><a href="./index.html">Home</a></li>
                <li><a href="./about.html">About Us</a></li>
                <li><a href="./Admission.html">Admission</a></li>
                    <li><a href="./contact.html">Contact</a></li>
                    <div class="dropdown2">
                        <li><a href="#">More<span><i class="fa-solid fa-angle-down"></i></span></a></li>
                        <div class="dropdown2-content">
                        <li><a href="./updates.html">Upades</a></li>
                        <!-- <li><a href="#department">Academics</a></li> -->
                        <li><a href="./results.html">Results</a></li>
                        <li><a href="./results.html">Login</a></li>
                        </div>
                        </div>
                    </ul>
                </div>
            <i class="fa fa-bars" onclick ="showMenu()"></i>
        </nav>
    </div>

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
    
    <!------------ Footer ------------>
<section class="footer">
    <div class="footer-row">
        <h2>An-nur Model Islamic School</h2>
        <p>N0. 7 Brighter Road, Western Bye-pass, <br> Minna Niger State</p>
        <p><span>Email:</span>annureduservices@gmail.com</p>
        <p><span>Phone:</span>07038042711, 09019190684</p>
    </div>
    <div class="footer-row">
        <h2>Quick Links</h2>
        <ul>          
        <li class="current"><a href="./index.html">Home</a></li>
        <li><a href="./about.html">About Us</a></li>
        <li><a href="./Admission.html">Admission</a></li>
            <li><a href="./contact.html">Contact</a></li>
            <div class="dropdown2">
                <li><a href="#">More<span><i class="fa-solid fa-angle-down"></i></span></a></li>
                <div class="dropdown2-content">
                <li><a href="./updates.html">Upades</a></li>
                <!-- <li><a href="#department">Academics</a></li> -->
                <li><a href="./results.html">Results</a></li>
                </div>
                </div>
    </ul>
    </div>
    <div class="footer-row">
        <h2>Subscribe to Our Newsletter</h2>
        <input type="text" name="email" placeholder="Your Email"><br>
        <button class="white-btn">Subscribe</button>
        </div>
</section>

<script src="{{ url ('public/frontend/JS/script.js') }}"></script>
<script src="{{ url ('public/frontend/JS/bootstrap.bundle.min.js') }}"></script>
  </body>
</html>
