@extends('front.layout.layout')
@section('content')
    <!-- Content -->
    <main class="main">
        <div class="breacrumb-cover">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('home.index') }}">Home</a></li>
                    <li>{{ Auth::user()->name }}</li>
                </ul>
            </div>
        </div>
        <section class="section-box mt-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                        <div class="employers-header-2">
                            <div class="heading-image-rd online">
                                <a href="#">
                                    <figure><img alt="jobhub" src="{{ Auth::user()->image_link }}"></figure>
                                </a>
                            </div>
                            <div class="heading-main-info">
                                <h4>{{ Auth::user()->name }}</h4>
                                <div class="head-info-profile">
                                    <span class="text-small mr-20"><i class="fi-rr-marker text-mutted"></i>
                                        {{ Auth::user()->address }}</span>
                                    <span class="text-small mr-20"><i class="fi-rr-briefcase text-mutted"></i>
                                        {{ Auth::user()->additionalInfo->position ?? '' }}</span>
                                    <span class="text-small"><i class="fi-rr-clock text-mutted"></i>
                                        {{ Auth::user()->additionalInfo->charge ?? '' }} / hour</span>
                                    {{-- <div class="rate-reviews-small">
                                    <span><img src="assets/imgs/theme/icons/star.svg" alt="jobhub" /></span>
                                    <span><img src="assets/imgs/theme/icons/star.svg" alt="jobhub" /></span>
                                    <span><img src="assets/imgs/theme/icons/star.svg" alt="jobhub" /></span>
                                    <span><img src="assets/imgs/theme/icons/star.svg" alt="jobhub" /></span>
                                    <span><img src="assets/imgs/theme/icons/star.svg" alt="jobhub" /></span>
                                    <span class="ml-10 text-muted text-small">(5.0)</span>
                                </div> --}}
                                </div>
                                <div class="row align-items-end">
                                    @php
                                        if (Auth::user()->additionalInfo && Auth::user()->additionalInfo->skills) {
                                            $skillsArr = explode(',', Auth::user()->additionalInfo->skills);
                                        }else{
                                            $skillsArr = [];
                                        }

                                    @endphp
                                    <div class="col-lg-8">
                                        @if ($skillsArr)
                                            @foreach ($skillsArr as $item)
                                                @php
                                                    $skill = App\Models\Skills::find($item);
                                                @endphp
                                                <a href="#" class="btn btn-tags-sm mb-10 mr-5">{{ $skill->name }}</a>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-lg-4 text-lg-end">
                                        <a href="{{ Auth::user()->additionalInfo->resume_link ?? ''}}"
                                            class="btn btn-default">Download CV</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content-single">
                            <h4 class="mb-20">Biography</h4>
                            <p>
                                {{ Auth::user()->additionalInfo->bio ?? ''}}
                            </p>
                        </div>
                        <div class="single-apply-jobs">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <a href="#" class="btn btn-default mr-15">Hire Now</a>
                                    <a href="#" class="btn btn-border">Save</a>
                                </div>
                                <div class="col-md-7 text-lg-end social-share">
                                    <a href="#" class="btn btn-border btn-sm mr-10"><img alt="jobhub"
                                            src="{{ url('public/assets/imgs/theme/icons/share-fb.svg') }}" /> Share</a>
                                    <a href="#" class="btn btn-border btn-sm mr-10"><img alt="jobhub"
                                            src="{{ url('public/assets/imgs/theme/icons/share-tw.svg') }}" /> Tweet</a>
                                    <a href="#" class="btn btn-border btn-sm"><img alt="jobhub"
                                            src="{{ url('public/assets/imgs/theme/icons/share-pinterest.svg') }}" />
                                        Pin</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
                        <div class="sidebar-shadow">
                            <h5 class="font-bold">Overview</h5>
                            <div class="sidebar-list-job mt-10">
                                <ul>
                                    <li>
                                        <div class="sidebar-icon-item"><i class="fi-rr-briefcase"></i></div>
                                        <div class="sidebar-text-info">
                                            <span class="text-description">Experience</span>
                                            <strong class="small-heading">{{ Auth::user()->additionalInfo->experience ?? ''}}
                                                years</strong>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-icon-item"><i class="fi-rr-marker"></i></div>
                                        <div class="sidebar-text-info">
                                            <span class="text-description">From</span>
                                            <strong class="small-heading">{{ Auth::user()->address }}</strong>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-icon-item"><i class="fi-rr-dollar"></i></div>
                                        <div class="sidebar-text-info">
                                            <span class="text-description">Salary</span>
                                            <strong class="small-heading">{{ Auth::user()->additionalInfo->charge ?? ''}} /
                                                hour</strong>
                                        </div>
                                    </li>
                                </ul>
                            </div>
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
                            <input type="text" class="input-newsletter" value=""
                                placeholder="contact.alithemes@gmail.com" />
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
