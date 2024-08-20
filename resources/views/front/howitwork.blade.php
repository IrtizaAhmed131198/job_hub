@extends('front.layout.layout')
@section('content')
<!-- Content -->
<main class="main">
    <section class="section-box">
        <div class="container pt-50">
            <div class="w-50 w-md-100 mx-auto text-center">
                <h1 class="section-title-large mb-30 wow animate__animated animate__fadeInUp">How It Works</h1>
                <p class="mb-30 text-muted wow animate__animated animate__fadeInUp font-md">This is part of our help center where frequently asked questions are collected. Do a search here before sending a message or contacting us, here are the most common problems you will encounter when using our system.</p>
            </div>
        </div>
    </section>

    <div class="faqs-imgs">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="row">
                        <div class="col-lg-7">
                            <img class="faqs-1 wow animate__animated animate__fadeIn" data-wow-delay=".1s" src="{{ url('public/assets/imgs/page/faqs/img-1.png') }}" alt="">
                        </div>
                        <div class="col-lg-5">
                            <img class="faqs-2 mb-15 wow animate__animated animate__fadeIn" data-wow-delay=".3s" src="{{ url('public/assets/imgs/page/faqs/img-2.png') }}" alt="">
                            <img class="faqs-3 wow animate__animated animate__fadeIn" data-wow-delay=".5s" src="{{ url('public/assets/imgs/page/faqs/img-3.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('front.subscribe')
</main>
<!-- End Content -->
@endsection
