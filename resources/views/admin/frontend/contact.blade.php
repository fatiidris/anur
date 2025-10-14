@extends('admin.frontend.layouts.layout')

@section('content')
<div class="container">
        <!-------- about us content -------->
    <section class="sub-header">
        <h1>Contact</h1>
    </section>
<!-------- contact us -------->
    <section class="locaton">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2018062.5377754625!2d7.476777661004616!3d8.923358659835968!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x104e0baf7da48d0d%3A0x99a8fe4168c50bc8!2sNigeria!5e0!3m2!1sen!2sng!4v1645451390224!5m2!1sen!2sng" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </section>


    <section class="contact-us">
        <h1>Get in Touch</h1>
        <div class="contact-row">
            <div class="contact-col">
                <div>
                <i class="fa fa-home"></i>
                <span>
                <h5>An-nur Model Islamic School</h5>
                <p>N0. 7 Brighter Road, Western Bye-pass, <br> Minna Niger State</p>
                </span>
            </div>
            <div>
        
                <i class="fa fa-phone"></i>
                <span>
                <h5>07038042711, 09019190684</h5>
                <p>Monday to friday 8am to 1pm morning<br>Weekends 10pm to 4pm</p>
                </span>
            </div>
            <div>
                <i class="fa fa-envelope"></i>
                <span>
                <h5>annureduservices@gmail.com</h5>
                <p>Email us your query</p>
                </span>
            </div>
            </div>
            <div class= "contact-col">

                <form action="form-handler.php" method="post">
                    <input type="text" name="name" placeholder="Enter your name" required>
                    <input type="email" name="email" placeholder="Enter email address" required>
                    <input type="text" name="subject" placeholder="Enter your subject" required>
                    <textarea rows="8" name="message" placeholder="Message" required></textarea>
                    <button type="submit" class="blue-btn">Send Message</button>
                </form>
            </div>
        </div>
    </section>

</div>
@endsection
