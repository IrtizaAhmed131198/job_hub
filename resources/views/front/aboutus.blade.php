@extends('front.layout.layout')
@section('content')
<!-- Content -->
<main class="main">
    <section class="section-box bg-banner-about">
        <div class="banner-hero banner-about pt-20">
            <div class="banner-inner">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="block-banner">
                            <h1 class="heading-banner heading-lg">The #1 Job Board for Graphic Design Jobs</h1>
                            <div class="banner-description box-mw-70 mt-30">Search and connect with the right candidates faster. This talent seach gives you the opportunity to find candidates who may be a perfect fit for your role</div>
                            <div class="mt-60">
                                <div class="box-button-shadow mr-10">
                                    <a href="#" class="btn btn-default">Contact us</a>
                                </div>
                                <a href="#" class="btn">Support center</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 d-none d-lg-block">
                        <div class="banner-imgs">
                            <img alt="jobhub" src="{{ url('public/assets/imgs/page/about/banner-img.png') }}" class="img-responsive main-banner shape-3" />
                            <span class="banner-sm-1"><img alt="jobhub" src="{{ url('public/assets/imgs/page/about/banner-sm-1.png') }}" class="img-responsive shape-1" /></span>
                            <span class="banner-sm-2"><img alt="jobhub" src="{{ url('public/assets/imgs/page/about/banner-sm-2.png') }}" class="img-responsive shape-1" /></span>
                            <span class="banner-sm-3"><img alt="jobhub" src="{{ url('public/assets/imgs/page/about/banner-sm-3.png') }}" class="img-responsive shape-2" /></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-90 mb-80">
        <div class="container">
            <div class="block-job-bg block-job-bg-homepage-2">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12 d-none d-md-block">
                        <div class="box-image-findjob findjob-homepage-2 ml-0 wow animate__animated animate__fadeIn">
                            <figure><img alt="jobhub" src="{{ url('public/assets/imgs/page/about/img-findjob.png') }}" /></figure>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="box-info-job pl-90 pt-30 pr-90">
                            <span class="text-blue wow animate__animated animate__fadeInUp">Find jobs</span>
                            <h5 class="heading-36 mb-30 mt-30 wow animate__animated animate__fadeInUp">Create free count and start apply your dream job today</h5>
                            <p class="text-lg wow animate__animated animate__fadeInUp">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is
                                simply dummy.
                            </p>
                            <div class="mt-30 wow animate__animated animate__fadeInUp">
                                <a href="job-grid.html" class="btn btn-default">Explore more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-box mt-90 mt-md-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                    <span class="text-lg text-brand wow animate__animated animate__fadeInUp">Online Marketing</span>
                    <h3 class="mt-20 mb-30 wow animate__animated animate__fadeInUp">Committed to top quality and results</h3>
                    <p class="mb-20 wow animate__animated animate__fadeInUp">Proin ullamcorper pretium orci. Donec necscele risque leo. Nam massa dolor imperdiet neccon sequata congue idsem. Maecenas malesuada faucibus finibus. </p>
                    <p class="mb-30 wow animate__animated animate__fadeInUp">Proin ullamcorper pretium orci. Donec necscele risque leo. Nam massa dolor imperdiet neccon sequata congue idsem. Maecenas malesuada faucibus finibus. </p>
                    <div class="mt-10 wow animate__animated animate__fadeInUp">
                        <a href="#" class="btn btn-default">Learn more</a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 col-sm-12 col-12 pl-200 d-none d-lg-block">
                    <div class="banner-imgs banner-imgs-about">
                        <img alt="jobhub" src="{{ url('public/assets/imgs/page/about/banner-online-marketing.png') }}" class="img-responsive main-banner shape-3" />
                        <span class="banner-sm-4"><img alt="jobhub" src="{{ url('public/assets/imgs/banner/congratulation.svg') }}" class="img-responsive shape-2" /></span>
                        <span class="banner-sm-5"><img alt="jobhub" src="{{ url('public/assets/imgs/banner/web-dev.svg') }}" class="img-responsive shape-1" /></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-box mt-50">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-7 col-md-7">
                    <h2 class="section-title mb-20 wow animate__animated animate__fadeInUp hover-up" data-wow-delay=".1s">From blog</h2>
                    <p class="text-md-lh28 color-black-5 wow animate__animated animate__fadeInUp hover-up" data-wow-delay=".1s">Latest News & Events</p>
                </div>
                <div class="col-lg-5 col-md-5 text-lg-end text-start">
                    <a href="blog-grid.html" class="btn btn-border icon-chevron-right wow animate__animated animate__fadeInUp hover-up mt-15" data-wow-delay=".1s">View more</a>
                </div>
            </div>
            <div class="row mt-70">
                <div class="box-swiper">
                    <div class="swiper-container swiper-group-3">
                        <div class="swiper-wrapper pb-70 pt-5">
                            @foreach($blog as $val)
                            @php
                                $dateString = $val->published_at;
                                $date = Carbon\Carbon::parse($dateString);
                                $formattedDate = $date->format('d-F-Y');

                                $limitedContent = Illuminate\Support\Str::words($val->content, 7, '...');
                            @endphp
                                <div class="swiper-slide">
                                    <div class="card-grid-3 hover-up">
                                        <div class="text-center card-grid-3-image">
                                            <a href="blog-single.html">
                                                <figure><img src="{{ $val->image_link }}" /></figure>
                                            </a>
                                        </div>
                                        <div class="card-block-info">
                                            <div class="row">
                                                <div class="col-lg-6 col-6 text-start">
                                                    <span>{{ $val->title }}</span>
                                                </div>
                                                <div class="col-lg-6 col-6 text-end">
                                                    <span>{{ $formattedDate }}</span>
                                                </div>
                                            </div>
                                            <h5 class="mt-15 heading-md"><a href="{{ route('blog.inner', ['id' => $val->id]) }}">{{ $limitedContent }}</a></h5>
                                            <div class="card-2-bottom mt-50">
                                                <div class="row">
                                                    <div class="col-lg-9 col-8">
                                                        <a href="{{ route('blog.inner', ['id' => $val->id]) }}" class="btn btn-border btn-brand-hover">Keep reading</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination swiper-pagination3"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('front.subscribe')
</main>
<!-- End Content -->
@endsection
