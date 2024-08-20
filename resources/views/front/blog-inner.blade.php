@extends('front.layout.layout')
@section('content')
<!-- Content -->
<main class="main">
    <div class="breacrumb-cover">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{ route('home.index') }}">Home</a></li>
                <li>Blog</li>
            </ul>
        </div>
    </div>
    <div class="archive-header pt-50 pb-50 text-center">
        <div class="container">
            <h3 class="mb-30 text-center w-75 mx-auto">
                11 Companies That Hire for Remote Seasonal and Holiday Jobs
            </h3>
            <div class="post-meta text-muted d-flex align-items-center mx-auto justify-content-center">
                <div class="author d-flex align-items-center mr-30">
                    <img alt="jobhub" src="{{ $data->image_link }}" />
                    <span>{{ $data->title }}</span>
                </div>
                @php
                    $dateString = $data->published_at;
                    $date = Carbon\Carbon::parse($dateString);
                    $formattedDate = $date->format('d-F-Y');
                @endphp
                <div class="date mr-30">
                    <span><i class="fi-rr-edit mr-5 text-grey-6"></i>{{ $formattedDate }}</span>
                </div>
                <div class="icons">
                    <a href="#"><i class="fi fi-rr-bookmark mr-5 text-muted"></i></a>
                    <a href="#"><i class="fi fi-rr-heart text-muted"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="post-loop-grid">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-body">
                        <figure class="mb-30">
                            <img src="{{ $data->image_link }}" alt="">
                        </figure>
                        {{-- <div class="excerpt mb-30">
                            <p>Helping everyone live happier, healthier lives at home through their kitchen. Kitchn is a daily food magazine on the Web celebrating life in the kitchen through home cooking and kitchen intelligence.</p>
                        </div> --}}
                        <div class="single-content">
                            <p>{{ $data->content }}</p>
                        </div>
                        {{-- <div class="author-bio p-30 mt-50 border-radius-15 bg-white">
                            <div class="author-image mb-15">
                                <a href="author.html"><img src="assets/imgs/avatar/ava_14.png" alt="" class="avatar"></a>
                                <div class="author-infor">
                                    <h5 class="mb-5">Steven Job</h5>
                                    <p class="mb-0 text-muted font-xs">
                                        <span class="mr-10">306 posts</span>
                                        <span class="has-dot">Since 2012</span>
                                    </p>
                                </div>
                            </div>
                            <div class="author-des">
                                <p>Hi, I'm a recruiter with over 25 years of experience. I have worked in many multinational companies and corporations. With my experiences, I hope my articles will bring you knowledge and inspiration.</p>
                            </div>
                        </div> --}}

                        <div class="related-posts mt-50">
                            <h4 class="mb-30">Related Posts</h4>
                            <div class="box-swiper">
                                <div class="swiper-container swiper-group-3">
                                    <div class="swiper-wrapper pb-30 pt-5">
                                        @foreach($related as $val)
                                            <div class="swiper-slide">
                                                <div class="card-grid-3 hover-up p-15">
                                                    <a href="blog-single.html">
                                                        <figure><img alt="jobhub" src="{{ $val->image_link }}" /></figure>
                                                    </a>
                                                    <h6 class="heading-md mt-15 mb-0"><a href="blog-single.html">{{ $val->title }}</a></h6>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination swiper-pagination3"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
                    {{-- <div class="widget_search mb-40">
                        <div class="search-form">
                            <form action="#">
                                <input type="text" placeholder="Search…">
                                <button type="submit"><i class="fi-rr-search"></i></button>
                            </form>
                        </div>
                    </div> --}}
                    <div class="sidebar-shadow widget-categories">
                        <h5 class="sidebar-title">Category</h5>
                        <ul>
                            <li class="d-flex justify-content-between align-items-center">
                                <a href="blog-grid.html">Recruitment News</a>
                                <span class="count">28</span>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <a href="blog-grid.html">Job Venues</a>
                                <span class="count">32</span>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <a href="blog-grid.html">Full Time Job</a>
                                <span class="count">45</span>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <a href="blog-grid.html">Work From Home</a>
                                <span class="count">68</span>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <a href="blog-grid.html">Job Tips</a>
                                <span class="count">43</span>
                            </li>
                        </ul>
                    </div>
                    <div class="sidebar-shadow">
                        <h5 class="sidebar-title">Popular Tags</h5>
                        <div class="block-tags">
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">Figma</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">Adobe XD</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">PSD</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">HTML 5</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">Css 3</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">Javascript</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">Jquery</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">NodeJS</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">MongoDb</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">SEO expert</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">Gimp</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">PSD</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">Photo editing</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">Sketch</a>
                            <a href="#" class="btn btn-tags-sm mb-10 mr-5">jam</a>
                        </div>
                    </div>
                    <div class="sidebar-normal">
                        <div>
                            <h6 class="small-heading">Are you also hiring?</h6>
                            <ul class="ul-lists">
                                <li><a href="#">Writing & Translation</a></li>
                                <li><a href="#">Video & Animation</a></li>
                                <li><a href="#">Music & Audio</a></li>
                                <li><a href="#">Digital Marketing</a></li>
                                <li><a href="#">Business</a></li>
                                <li><a href="#">Programming & Tech</a></li>
                            </ul>
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
