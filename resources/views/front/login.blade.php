@extends('front.layout.layout')
@section('content')
    <!-- Content -->
    <main class="main">
        <section class="section-box">
            <div class="container pt-50">
                <div class="w-50 w-md-100 mx-auto text-center">
                    <h1 class="section-title-large mb-30 wow animate__animated animate__fadeInUp">Sign In</h1>
                    <p class="mb-30 text-muted wow animate__animated animate__fadeInUp font-md">Login your account to apply the job</p>
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
                                <form class="contact-form-style mt-80" id="signup-form" action="{{ url('login') }}" method="post">
                                    @csrf
                                    <div class="row wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="input-style mb-20">
                                                <input name="email" placeholder="Your Email" type="email" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="input-style mb-20">
                                                <input name="password" placeholder="Your Password" type="password" />
                                            </div>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                                <label class="form-check-label" for="remember">
                                                    Remember Me
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <button type="submit" class="btn btn-primary">Sign In</button>
                                        </div>
                                        <div class="col-12">
                                            <a href="{{ url('forgot-password') }}" class="text-muted">Forgot Password?</a>
                                        </div>
                                        <div class="col-12">
                                            <a href="{{ url('resend-otp') }}" class="text-muted">Resend OTP</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>
    <!-- End Content -->
@endsection
