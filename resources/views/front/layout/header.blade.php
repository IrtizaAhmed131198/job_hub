<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Jobhub</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('public/assets/imgs/theme/favicon.svg') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ url('public/assets/css/plugins/animate.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/main.css') }}">
    <!--Sweetalert-->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ url('public/assets/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @yield('css')
    <!-- Bootstrap CSS -->

</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{ url('public/assets/imgs/theme/loading.gif') }}" alt="jobhub">
                </div>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    <!-- Header Start -->
    <header class="header sticky-bar">
        <div class="container">
            <div class="main-header">
                <div class="header-left">
                    <div class="header-logo">
                        <a href="{{ route('home.index') }}" class="d-flex">
                            <img src="{{ url('public/assets/imgs/theme/jobhub-logo.svg') }}" alt="jobhub">
                        </a>
                    </div>
                    <div class="header-nav">
                        <nav class="nav-main-menu d-none d-xl-block">
                            <ul class="main-menu">
                                <li><a class="active" href="{{ route('home.index') }}">Home</a></li>
                                <li><a href="{{ route('aboutus') }}">About Us</a></li>
                                <li><a href="{{ route('howitwork') }}">How It Work</a></li>
                                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                <li><a href="{{ route('job') }}">Browse Jobs</a></li>
                            </ul>
                        </nav>
                        <div class="burger-icon burger-icon-white">
                            <span class="burger-icon-top"></span>
                            <span class="burger-icon-mid"></span>
                            <span class="burger-icon-bottom"></span>
                        </div>
                    </div>
                </div>
                <div class="header-right">
                    <div class="block-signin">
                        {{-- <a href="#" class="text-link-bd-btom hover-up">Apply Now</a> --}}
                        @if (Auth::check())
                            <a href="{{ route('dashboard') }}"
                                class="btn btn-default btn-shadow ml-40 hover-up">Dashboard</a>
                        @else
                            <a href="{{ route('users.login') }}" class="btn btn-default btn-shadow ml-40 hover-up">Sign
                                in</a>
                            <a href="{{ route('users.signup') }}"
                                class="btn btn-default btn-shadow ml-40 hover-up">Sign up</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->


    <!-- Mobile Header -->
    <div class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar">
        <div class="mobile-header-wrapper-inner">

                <div class="mobile-header-top">
                    @if (Auth::check())
                    <div class="user-account">
                        <img src="{{ Auth::user()->image_link }}" alt="jobhub">
                        <div class="content">
                            <h6 class="user-name">{{ Auth::user()->name }}</h6>
                        </div>
                    </div>
                    @endif
                    <div class="burger-icon burger-icon-white">
                        <span class="burger-icon-top"></span>
                        <span class="burger-icon-mid"></span>
                        <span class="burger-icon-bottom"></span>
                    </div>
                </div>
            <div class="mobile-header-content-area">
                <div class="perfect-scroll">
                    <div class="mobile-menu-wrap mobile-header-border">
                        <nav>
                            <ul class="mobile-menu font-heading">
                                <li class="has-children">
                                    <a class="active" href="{{ route('home.index') }}">Home</a>
                                </li>
                                <li class="has-children">
                                    <a href="{{ route('job') }}">Browse Jobs</a>
                                </li>
                                <li class="has-children">
                                    <a href="#">Pages</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('aboutus') }}">About Us</a></li>
                                        <li><a href="{{ route('howitwork') }}">How It Work</a></li>
                                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    @if (Auth::check())
                        <div class="mobile-account">
                            <h6 class="mb-10">Your Account</h6>
                            <ul class="mobile-menu font-heading">
                                <li><a href="{{ route('viewProfile') }}">Profile</a></li>
                                <li><a href="{{ route('users.logout') }}">Sign Out</a></li>
                            </ul>
                        </div>
                    @endif
                    @php
                        $settings = App\Models\Settings::latest()->first();
                    @endphp
                    <div class="mobile-social-icon mb-50">
                        <h6 class="mb-25">Follow Us</h6>
                        <a href="{{ $settings->facebook ?? '' }}"><img src="{{ url('public/assets/imgs/theme/icons/icon-facebook.svg') }}"
                                alt="jobhub"></a>
                        <a href="{{ $settings->twitter ?? '' }}"><img src="{{ url('public/assets/imgs/theme/icons/icon-twitter.svg') }}"
                                alt="jobhub"></a>
                        <a href="{{ $settings->instagram ?? '' }}"><img src="{{ url('public/assets/imgs/theme/icons/icon-instagram.svg') }}"
                                alt="jobhub"></a>
                        <a href="{{ $settings->pinterest ?? '' }}"><img src="{{ url('public/assets/imgs/theme/icons/icon-pinterest.svg') }}"
                                alt="jobhub"></a>
                        <a href="{{ $settings->youtube ?? '' }}"><img src="{{ url('public/assets/imgs/theme/icons/icon-youtube.svg') }}"
                                alt="jobhub"></a>
                    </div>
                    <div class="site-copyright">Copyright 2022 © JobHub. <br />Designed by AliThemes.</div>
                </div>
            </div>
        </div>
    </div>
    <!--End header-->
