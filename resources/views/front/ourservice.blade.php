@extends('front.layout.layout')
@section('content')
<!-- Content -->
<main class="main">
    <section class="section-box">
        <div class="container pt-50">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8 text-center">
                    <h1 class="section-title-large mb-30 wow animate__animated animate__fadeInUp">Our services</h1>
                    <h5 class="mb-30 text-muted wow animate__animated animate__fadeInUp">Tellus praesent vulputate placerat enim donec eget fermentum diam nunc erat commodo ornare eget lorem pharetra sit pharetra</h5>
                </div>
            </div>
            <div class="box-banner-services mt-40">
                <div class="box-banner-services--inner wow animate__animated animate__fadeInUp">
                    <figure><img alt="jobhub" src="{{ url('public/assets/imgs/page/services/banner-our-services.png') }}" /></figure>
                    <a href="https://www.youtube.com/watch?v=ea-I4sqgVGY" class="popup-youtube btn-play-2"></a>
                </div>
            </div>
        </div>
    </section>
    <section class="section-box mt-90 mb-50 mb-md-0">
        <div class="container">
            <div class="mw-650">
                <h4 class="text-center wow animate__animated animate__fadeInUp">Rapidly provision one to thousands of Droplets in seconds </h4>
            </div>
            <div class="row mt-60">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-md-30">
                    <div class="card-none-bd hover-up wow animate__animated animate__fadeInUp" data-wow-delay=".0s">
                        <div class="block-image">
                            <figure><img alt="jobhub" src="{{ url('public/assets/imgs/page/services/ready-project.svg') }}" /></figure>
                        </div>
                        <div class="card-info-bottom">
                            <h3><span class="count">15</span>00+</h3>
                            <strong>Ready perfect jobs</strong>
                            <p class="text-mutted">A place to think and track ideas</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-md-30">
                    <div class="card-none-bd hover-up wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <div class="block-image">
                            <figure><img alt="jobhub" src="{{ url('public/assets/imgs/page/services/candidate-call.svg') }}" /></figure>
                        </div>
                        <div class="card-info-bottom">
                            <h3><span class="count">8</span>00K</h3>
                            <strong>Candidate calls</strong>
                            <p class="text-mutted">A place to think and track ideas</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-md-30">
                    <div class="card-none-bd hover-up wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <div class="block-image">
                            <figure><img alt="jobhub" src="{{ url('public/assets/imgs/page/services/job-posted.svg') }}" /></figure>
                        </div>
                        <div class="card-info-bottom">
                            <h3><span class="count">12</span>00</h3>
                            <strong>Jobs posted</strong>
                            <p class="text-mutted">A place to think and track ideas</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card-none-bd hover-up wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                        <div class="block-image">
                            <figure><img alt="jobhub" src="{{ url('public/assets/imgs/page/services/complete-jobs.svg') }}" /></figure>
                        </div>
                        <div class="card-info-bottom">
                            <h3><span class="count">6</span>00K</h3>
                            <strong>Complete Jobs</strong>
                            <p class="text-mutted">A place to think and track ideas</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-100">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card-grid-news hover-up wow animate__animated animate__fadeIn" data-wow-delay=".0s">
                        <div class="block-image-rd">
                            <figure><img src="{{ url('public/assets/imgs/page/services/img-news1.png') }}" /></figure>
                        </div>
                        <div class="card-info-bottom">
                            <a href="#"><strong>Jobs finder platform</strong></a>
                            <p class="text-gray-200">
                                usce ex quam, ultrices id congue non, varius non libero. Cras ut venenatis lectus, vitae eleifend mi. Morbi venenatis leo et turpis lobortis malesuada. Pellentesque tempus est et nibh porttito
                            </p>
                            <ul>
                                <li><a href="#">Market research</a></li>
                                <li><a href="#">Strategic Consulting</a></li>
                                <li><a href="#">Effective Planning</a></li>
                                <li><a href="#">Effective Planning</a></li>
                                <li><a href="#">Effective Planning</a></li>
                                <li><a href="#">Effective Planning</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card-grid-news hover-up wow animate__animated animate__fadeIn" data-wow-delay=".2s">
                        <div class="block-image-rd">
                            <figure><img src="{{ url('public/assets/imgs/page/services/img-news2.png') }}" /></figure>
                        </div>
                        <div class="card-info-bottom">
                            <a href="#"><strong>Jobs finder platform</strong></a>
                            <p class="text-gray-200">
                                usce ex quam, ultrices id congue non, varius non libero. Cras ut venenatis lectus, vitae eleifend mi. Morbi venenatis leo et turpis lobortis malesuada. Pellentesque tempus est et nibh porttito
                            </p>
                            <ul>
                                <li><a href="#">Market research</a></li>
                                <li><a href="#">Strategic Consulting</a></li>
                                <li><a href="#">Effective Planning</a></li>
                                <li><a href="#">Effective Planning</a></li>
                                <li><a href="#">Effective Planning</a></li>
                                <li><a href="#">Effective Planning</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card-grid-news hover-up wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                        <div class="block-image-rd">
                            <figure><img src="{{ url('public/assets/imgs/page/services/img-news4.png') }}" /></figure>
                        </div>
                        <div class="card-info-bottom">
                            <a href="#"><strong>Jobs finder platform</strong></a>
                            <p class="text-gray-200">
                                usce ex quam, ultrices id congue non, varius non libero. Cras ut venenatis lectus, vitae eleifend mi. Morbi venenatis leo et turpis lobortis malesuada. Pellentesque tempus est et nibh porttito
                            </p>
                            <ul>
                                <li><a href="#">Market research</a></li>
                                <li><a href="#">Strategic Consulting</a></li>
                                <li><a href="#">Effective Planning</a></li>
                                <li><a href="#">Effective Planning</a></li>
                                <li><a href="#">Effective Planning</a></li>
                                <li><a href="#">Effective Planning</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card-grid-news hover-up wow animate__animated animate__fadeIn" data-wow-delay=".0s">
                        <div class="block-image-rd">
                            <figure><img src="{{ url('public/assets/imgs/page/services/img-news5.png') }}" /></figure>
                        </div>
                        <div class="card-info-bottom">
                            <a href="#"><strong>Jobs finder platform</strong></a>
                            <p class="text-gray-200">
                                usce ex quam, ultrices id congue non, varius non libero. Cras ut venenatis lectus, vitae eleifend mi. Morbi venenatis leo et turpis lobortis malesuada. Pellentesque tempus est et nibh porttito
                            </p>
                            <ul>
                                <li><a href="#">Market research</a></li>
                                <li><a href="#">Strategic Consulting</a></li>
                                <li><a href="#">Effective Planning</a></li>
                                <li><a href="#">Effective Planning</a></li>
                                <li><a href="#">Effective Planning</a></li>
                                <li><a href="#">Effective Planning</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card-grid-news hover-up wow animate__animated animate__fadeIn" data-wow-delay=".2s">
                        <div class="block-image-rd">
                            <figure><img src="{{ url('public/assets/imgs/page/services/img-news2.png') }}" /></figure>
                        </div>
                        <div class="card-info-bottom">
                            <a href="#"><strong>Jobs finder platform</strong></a>
                            <p class="text-gray-200">
                                usce ex quam, ultrices id congue non, varius non libero. Cras ut venenatis lectus, vitae eleifend mi. Morbi venenatis leo et turpis lobortis malesuada. Pellentesque tempus est et nibh porttito
                            </p>
                            <ul>
                                <li><a href="#">Market research</a></li>
                                <li><a href="#">Strategic Consulting</a></li>
                                <li><a href="#">Effective Planning</a></li>
                                <li><a href="#">Effective Planning</a></li>
                                <li><a href="#">Effective Planning</a></li>
                                <li><a href="#">Effective Planning</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card-grid-news hover-up wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                        <div class="block-image-rd">
                            <figure><img src="{{ url('public/assets/imgs/page/services/img-news6.png') }}" /></figure>
                        </div>
                        <div class="card-info-bottom">
                            <a href="#"><strong>Jobs finder platform</strong></a>
                            <p class="text-gray-200">
                                usce ex quam, ultrices id congue non, varius non libero. Cras ut venenatis lectus, vitae eleifend mi. Morbi venenatis leo et turpis lobortis malesuada. Pellentesque tempus est et nibh porttito
                            </p>
                            <ul>
                                <li><a href="#">Market research</a></li>
                                <li><a href="#">Strategic Consulting</a></li>
                                <li><a href="#">Effective Planning</a></li>
                                <li><a href="#">Effective Planning</a></li>
                                <li><a href="#">Effective Planning</a></li>
                                <li><a href="#">Effective Planning</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-box mt-70 mt-md-0">
        <div class="container">
            <h2 class="section-title mb-15 wow animate__animated animate__fadeInUp">Our Happy Customer</h2>
            <div class="row">
                <div class="col-lg-7">
                    <div class="text-md-lh24 color-black-5 wow animate__animated animate__fadeInUp">
                        When it comes to choosing the right web hosting provider, we know how easy it is to get overwhelmed
                        with the number.
                    </div>
                </div>
            </div>
            <div class="row mt-50">
                <div class="box-swiper">
                    <div class="swiper-container swiper-group-2">
                        <div class="swiper-wrapper pb-70 pt-5">
                            <div class="swiper-slide">
                                <div class="card-two-collumn hover-up">
                                    <div class="text-center card-grid-3-image">
                                        <a href="#">
                                            <figure><img alt="jobhub" src="{{ url('public/assets/imgs/page/services/profile.png') }}" /></figure>
                                        </a>
                                    </div>
                                    <div class="card-block-info quote-left mt-10">
                                        <h5 class="heading-md font-semibold mb-20">Design Quality and Customer Support</h5>
                                        <p class="text-md">Our creative strategy is focused on inspiring customers to live
                                            more sustainable and healthy lives. The Senior Designer works to elevate the
                                            brand and creates</p>
                                        <div class="card-bottom-bd">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="card-profile">
                                                        <strong>Azumi Shine</strong>
                                                        <span>Google UI UX Design</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mt-15 text-end">
                                                        <div class="rate">
                                                            <input type="radio" id="star5" name="rate" value="5" />
                                                            <label for="star5" title="text">5 stars</label>
                                                            <input type="radio" id="star4" name="rate" value="4" />
                                                            <label for="star4" title="text" class="checked">4 stars</label>
                                                            <input type="radio" id="star3" name="rate" value="3" />
                                                            <label for="star3" title="text" class="checked">3 stars</label>
                                                            <input type="radio" id="star2" name="rate" value="2" />
                                                            <label for="star2" title="text" class="checked">2 stars</label>
                                                            <input type="radio" id="star1" name="rate" value="1" />
                                                            <label for="star1" title="text" class="checked">1 star</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card-two-collumn hover-up">
                                    <div class="text-center card-grid-3-image">
                                        <a href="#">
                                            <figure><img alt="jobhub" src="{{ url('public/assets/imgs/page/services/profile3.png') }}" /></figure>
                                        </a>
                                    </div>
                                    <div class="card-block-info quote-left mt-10">
                                        <h5 class="heading-md font-semibold mb-20">Price and Product's Value</h5>
                                        <p class="text-md">Our creative strategy is focused on inspiring customers to live
                                            more sustainable and healthy lives. The Senior Designer works to elevate the
                                            brand and creates</p>
                                        <div class="card-bottom-bd">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="card-profile">
                                                        <strong>Steven Jhan</strong>
                                                        <span>Aplle inc / Graphic Design</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="rate">
                                                        <input type="radio" id="star52" name="rate" value="5" />
                                                        <label for="star52" title="text" class="checked">5 stars</label>
                                                        <input type="radio" id="star42" name="rate" value="4" />
                                                        <label for="star42" title="text" class="checked">4 stars</label>
                                                        <input type="radio" id="star32" name="rate" value="3" />
                                                        <label for="star32" title="text" class="checked">3 stars</label>
                                                        <input type="radio" id="star22" name="rate" value="2" />
                                                        <label for="star22" title="text" class="checked">2 stars</label>
                                                        <input type="radio" id="star12" name="rate" value="1" />
                                                        <label for="star12" title="text" class="checked">1 star</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card-two-collumn">
                                    <div class="text-center card-grid-3-image">
                                        <a href="#">
                                            <figure><img alt="jobhub" src="{{ url('public/assets/imgs/page/services/profile2.png') }}" /></figure>
                                        </a>
                                    </div>
                                    <div class="card-block-info quote-left mt-10">
                                        <h5 class="heading-md font-semibold mb-20">The best place to hire</h5>
                                        <p class="text-md">Our mission is to create the world's most sustainable
                                            healthcare company by creating high-quality healthcare products in iconic,
                                            sustainable packaging.</p>
                                        <div class="card-bottom-bd">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="card-profile">
                                                        <strong>Azumi Shine</strong>
                                                        <span>Google UI UX Design</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mt-15 text-end">
                                                        <div class="rate">
                                                            <input type="radio" id="star53" name="rate" value="5" />
                                                            <label for="star53" title="text" class="checked">5 stars</label>
                                                            <input type="radio" id="star43" name="rate" value="4" />
                                                            <label for="star43" title="text" class="checked">4 stars</label>
                                                            <input type="radio" id="star33" name="rate" value="3" />
                                                            <label for="star33" title="text" class="checked">3 stars</label>
                                                            <input type="radio" id="star23" name="rate" value="2" />
                                                            <label for="star23" title="text" class="checked">2 stars</label>
                                                            <input type="radio" id="star13" name="rate" value="1" />
                                                            <label for="star13" title="text" class="checked">1 star</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination swiper-pagination3"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
