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
            <img src="{{ url ('public/frontend/Img/images.jpg') }}" alt="Description of the image">
               <div> 
                <h3>An-nur</h3>
                <p>Model School</p>
            </div>
            </label>
            <div class="nav-links" Id="checkmenu">
                <ul>
                    <i class="fa fa-times" onclick ="hideMenu()"></i>          
                <li class="current"><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('admission') }}">Admission</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                    <div class="dropdown2">
                        <li><a href="#">More<span><i class="fa-solid fa-angle-down"></i></span></a></li>
                        <div class="dropdown2-content">
                        <li><a href="{{ route('updates') }}">Updates</a></li>
                        <!-- <li><a href="#department">Academics</a></li> -->
                        <li><a href="{{ route('results') }}">Results</a></li>
                        <li><a href="{{ route('login') }}">Login</a></li>
                        </div>
                        </div>
                    </ul>
                </div>
            <i class="fa fa-bars" onclick ="showMenu()"></i>
        </nav>