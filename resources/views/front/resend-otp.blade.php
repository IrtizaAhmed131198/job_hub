@extends('front.layout.layout')
@section('content')
    <!-- Content -->
    <main class="main">
        <section class="section-box">
            <div class="container pt-50">
                <div class="w-50 w-md-100 mx-auto text-center">
                    <h1 class="section-title-large mb-30 wow animate__animated animate__fadeInUp">Resend OTP (One Time Password)</h1>
                    <p class="mb-30 text-muted wow animate__animated animate__fadeInUp font-md">Enter your otp
                    </p>
                </div>
            </div>
        </section>
        <div class="container mt-md-30">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <section class="mb-50">
                        <div class="row">
                            <div class="col-xl-9 col-md-12 mx-auto">
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
                                <form class="contact-form-style mt-80" id="signup-form" action="{{ route('users.postResendOtp') }}" method="post">
                                    @csrf
                                    <div class="row wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="input-style mb-20">
                                                <input name="email" placeholder="Enter your email" type="email" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Resend</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
                </section>
            </div>
        </div>
        </div>
    </main>
    <!-- End Content -->
@endsection
