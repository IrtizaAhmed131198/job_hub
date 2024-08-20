@extends('front.layout.layout')
@section('content')
<!-- Content -->
<main class="main">
    <section class="section-box">
        <div class="container pt-50">
            <div class="w-50 w-md-100 mx-auto text-center">
                <h1 class="section-title-large mb-30 wow animate__animated animate__fadeInUp">Contact Us</h1>
                <p class="mb-30 text-muted wow animate__animated animate__fadeInUp font-md">This is part of our help center where frequently asked questions are collected. Do a search here before sending a message or contacting us, here are the most common problems you will encounter when using our system.</p>
            </div>
        </div>
    </section>
    <div class="container mt-90 mt-md-30">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <section class="mb-50">
                    <h5 class="text-blue text-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s">Get in Touch</h5>
                    <h3 class="section-title w-75 w-md-100 mb-50 mt-15 text-center mx-auto wow animate__animated animate__fadeInUp" data-wow-delay=".1s">You are always welcome to visit our little studio</h3>
                    <div class="row mb-60">
                        <div class="col-md-4 mb-4 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                            <h5 class="mb-15">Office</h5>
                            205 North Michigan Avenue, Suite 810<br />
                            Chicago, 60601, USA<br />
                            <abbr title="Phone">Phone:</abbr> (123) 456-7890<br />
                            <abbr title="Email">Email: </abbr>contact@jubhub.com<br />
                            <a class="btn btn-default btn-small font-weight-bold text-white mt-20 border-radius-5 btn-shadow-brand hover-up"><i class="fi-rs-marker mr-5"></i>View map</a>
                        </div>
                        <div class="col-md-4 mb-4 mb-md-0 mt-sm-30 wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                            <h5 class="mb-15">Studio</h5>
                            205 North Michigan Avenue, Suite 810<br />
                            Chicago, 60601, USA<br />
                            <abbr title="Phone">Phone:</abbr> (123) 456-7890<br />
                            <abbr title="Email">Email: </abbr>contact@jubhub.com<br />
                            <a class="btn btn-default btn-small font-weight-bold text-white mt-20 border-radius-5 btn-shadow-brand hover-up"><i class="fi-rs-marker mr-5"></i>View map</a>
                        </div>
                        <div class="col-md-4 mt-sm-30 wow animate__animated animate__fadeInUp" data-wow-delay=".5s">
                            <h5 class="mb-15">Shop</h5>
                            205 North Michigan Avenue, Suite 810<br />
                            Chicago, 60601, USA<br />
                            <abbr title="Phone">Phone:</abbr> (123) 456-7890<br />
                            <abbr title="Email">Email: </abbr>contact@jubhub.com<br />
                            <a class="btn btn-default btn-small font-weight-bold text-white mt-20 border-radius-5 btn-shadow-brand hover-up"><i class="fi-rs-marker mr-5"></i>View map</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-9 col-md-12 mx-auto">
                            <div class="contact-from-area padding-20-row-col">
                                <h5 class="text-blue text-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s">Send Message</h5>
                                <h2 class="section-title mt-15 mb-10 text-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s">Drop Us a Line</h2>
                                <p class="text-muted mb-30 font-md text-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s">Your email address will not be published. Required fields are marked *</p>
                                <div class="row mt-50">
                                    <div class="col-md-4 text-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                                        <img src="assets/imgs/theme/icons/headset-color.svg" alt="">
                                        <p class="text-muted font-xs mb-10">Phone</p>
                                        <p class="mb-0 font-lg">
                                            + 48 654-430-309 <br>
                                            + 1 6532-430-309
                                        </p>
                                    </div>
                                    <div class="col-md-4 mt-sm-30 text-center wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                                        <img src="assets/imgs/theme/icons/marker-color.svg" alt="">
                                        <p class="text-muted font-xs mb-10">Email</p>
                                        <p class="mb-0 font-lg">
                                            contact@jobhub.com <br>
                                            sales@jobhub.com
                                        </p>
                                    </div>
                                    <div class="col-md-4 mt-sm-30 text-center wow animate__animated animate__fadeInUp" data-wow-delay=".5s">
                                        <img src="assets/imgs/theme/icons/plane-color.svg" alt="">
                                        <p class="text-muted font-xs mb-10">Address</p>
                                        <p class="mb-0 font-lg">
                                            11567 E Broadview Dr <br>
                                            Colorado(CO), 80117
                                        </p>
                                    </div>
                                </div>
                                <!-- Success Message -->
                                @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif

                                <!-- Error Message -->
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form class="contact-form-style mt-80" id="contact-form" action="{{ route('contact.send') }}" method="post">
                                    @csrf
                                    <div class="row wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="input-style mb-20">
                                                <input name="name" placeholder="First Name" type="text" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="input-style mb-20">
                                                <input name="email" placeholder="Your Email" type="email" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="input-style mb-20">
                                                <input name="telephone" placeholder="Your Phone" type="tel" required/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="input-style mb-20">
                                                <input name="subject" placeholder="Subject" type="text" required/>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 text-center">
                                            <div class="textarea-style mb-30">
                                                <textarea name="message" placeholder="Message" required></textarea>
                                            </div>
                                            <button class="submit submit-auto-width" type="submit">Send message</button>
                                        </div>
                                    </div>
                                </form>
                                <p class="form-messege"></p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <section class="section-box mt-50 mb-60">
        <div class="container">
            <div class="box-newsletter">
                <h5 class="text-md-newsletter">Sign up to get</h5>
                <h6 class="text-lg-newsletter">the latest jobs</h6>
                <div class="box-form-newsletter mt-30">
                    <form class="form-newsletter">
                        <input type="text" class="input-newsletter" value="" placeholder="contact.alithemes@gmail.com" />
                        <button class="btn btn-default font-heading icon-send-letter">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="box-newsletter-bottom">
                <div class="newsletter-bottom"></div>
            </div>
        </div>
    </section>
</main>
<!-- End Content -->
@endsection
