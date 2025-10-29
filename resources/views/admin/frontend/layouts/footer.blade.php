 <!------------ Footer ------------>
<section class="footer">
    <div class="footer-row">
        <h2>An-nur Model Islamic School</h2>
        <p>N0. 7 Brighter Road, Western Bye-pass, <br> Minna Niger State</p>
        <p><span>Email:</span><a href="mailto:annureduservices@gmail.com">annureduservices@gmail.com</a></p>
        <p><span>Phone:</span>07038042711, 09019190684</p>
    </div>
    <div class="footer-row">
        <h2>Quick Links</h2>
      <ul>          
        <li class="current"><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('about') }}">About Us</a></li>
        <li><a href="{{ route('admission') }}">Admission</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
            <div class="dropdown2">
                <li><a href="#">More<span><i class="fa-solid fa-angle-down"></i></span></a></li>
                <div class="dropdown2-content">
                <li><a href="{{ route('updates') }}">Upades</a></li>
                <!-- <li><a href="#department">Academics</a></li> -->
                <li><a href="{{ route('results') }}">Results</a></li>
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
