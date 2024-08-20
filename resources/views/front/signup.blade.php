@extends('front.layout.layout')
@section('content')
    <!-- Content -->
    <main class="main">
        <section class="section-box">
            <div class="container pt-50">
                <div class="w-50 w-md-100 mx-auto text-center">
                    <h1 class="section-title-large mb-30 wow animate__animated animate__fadeInUp">Sign Up</h1>
                    <p class="mb-30 text-muted wow animate__animated animate__fadeInUp font-md">Create your account for free</p>
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
                                <form class="contact-form-style mt-80" id="signup-form" action="{{ route('users.postSignup') }}" method="post">
                                    @csrf
                                    <div class="row wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="input-style mb-20">
                                                <input name="name" placeholder="Your Name" type="text" value="{{ old('name') }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="input-style mb-20">
                                                <input name="email" placeholder="Your Email" type="email" value="{{ old('email') }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="input-style mb-20">
                                                <input name="password" placeholder="Your Password" type="password" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="input-style mb-20">
                                                <input name="password_confirmation" placeholder="Confirm Password" type="password" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="input-style mb-20">
                                                <input name="mobile_number" placeholder="Mobile Number" type="tel" value="{{ old('mobile_number') }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="input-style mb-20">
                                                <input name="date_of_birth" placeholder="Date of Birth (YYYY-MM-DD)" type="date" value="{{ old('date_of_birth') }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="input-style mb-20">
                                                <select name="gender" class="gender">
                                                    <option value="">Select Gender</option>
                                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-style mb-20">
                                                <textarea name="address" placeholder="Address">{{ old('address') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="input-style mb-20">
                                                <input name="country" placeholder="Country" type="text" value="{{ old('country') }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="input-style mb-20">
                                                <input name="city" placeholder="City" type="text" value="{{ old('city') }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="input-style mb-20">
                                                <input name="postal_code" placeholder="Postal Code" type="text" value="{{ old('postal_code') }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="input-style mb-20">
                                                <input name="citizenship" placeholder="Citizenship" type="text" value="{{ old('citizenship') }}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="input-style mb-20">
                                                <input name="passport_number" placeholder="Passport Number (Optional)" type="text" value="{{ old('passport_number') }}" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Sign Up</button>
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
