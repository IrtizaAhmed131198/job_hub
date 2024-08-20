@extends('front.layout.layout')
@section('content')
    <style>
        .btn.disabled,
        .btn[aria-disabled="true"] {
            pointer-events: none;
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
    <!-- Content -->
    <main class="main">
        <section class="section-box">
            <div class="box-head-single">
                <div class="container">
                    <h3>{{ $data->title }}</h3>
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('home.index') }}">Home</a></li>
                        <li>Jobs listing</li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="section-box mt-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                        <div class="single-image-feature">
                            <figure><img alt="jobhub" src="{{ $data->image_link }}" class="img-rd-15" />
                            </figure>
                        </div>
                        <div class="content-single">
                            {!! isset($data->description) ? unserialize($data->description) : '' !!}
                        </div>
                        <div class="author-single">
                            <span>{{ $data->company }}</span>
                        </div>
                        <div class="single-apply-jobs">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    @if (Auth::check())
                                        @php
                                            $user = Auth::user();
                                            $canApply = false;
                                            if (!empty($user->subscription_plan)) {
                                                $order = \App\Models\Order::where('user_id', $user->id)
                                                    ->where('subscription_box', $user->subscription_plan)
                                                    ->where('status', 'completed')
                                                    ->latest('order_date')
                                                    ->first();

                                                if ($order) {
                                                    $subscriptionPlan = $user->subscription_plan;
                                                    $orderDate = \Carbon\Carbon::parse($order->order_date);
                                                    $today = \Carbon\Carbon::now();

                                                    if ($subscriptionPlan === 'Standard') {
                                                        $canApply = $today->lessThanOrEqualTo($orderDate->addDays(14));
                                                    } elseif ($subscriptionPlan === 'Premium') {
                                                        $canApply = $today->lessThanOrEqualTo($orderDate->addYear());
                                                    } elseif ($subscriptionPlan === 'Enterprise') {
                                                        $canApply = $today->lessThanOrEqualTo($orderDate->addMonths(3));
                                                    }
                                                }
                                            }
                                        @endphp

                                        @if ($canApply)
                                            <a href="{{ route('jobApplication', ['id' => $data->id]) }}"
                                                class="btn btn-default mr-15">Apply now</a>
                                        @else
                                            <a href="#" class="btn btn-default mr-15 disabled" aria-disabled="true"
                                                tabindex="-1">Apply now</a>
                                        @endif
                                    @else
                                        <a href="#" class="btn btn-default mr-15 disabled" aria-disabled="true"
                                            tabindex="-1">Apply now</a>
                                    @endif


                                </div>
                                <div class="col-md-7 text-lg-end social-share">
                                    <a href="#" class="btn btn-border btn-sm mr-10"><img alt="jobhub"
                                            src="{{ url('public/assets/imgs/theme/icons/share-fb.svg') }}" /> Share</a>
                                    <a href="#" class="btn btn-border btn-sm mr-10"><img alt="jobhub"
                                            src="{{ url('public/assets/imgs/theme/icons/share-tw.svg') }}" /> Tweet</a>
                                    <a href="#" class="btn btn-border btn-sm"><img alt="jobhub"
                                            src="{{ url('public/assets/imgs/theme/icons/share-pinterest.svg') }}" /> Pin</a>
                                </div>
                            </div>
                        </div>
                        <div class="single-recent-jobs">
                            <h4 class="heading-border"><span>Recent jobs</span></h4>
                            <div class="list-recent-jobs">
                                @foreach ($recent_jobs as $val)
                                    <div class="card-job hover-up wow animate__animated animate__fadeInUp">
                                        <div class="card-job-top">
                                            <div class="card-job-top--image">
                                                <figure><img alt="jobhub" src="{{ $val->company_logo_link }}" /></figure>
                                            </div>
                                            <div class="card-job-top--info">
                                                <h6 class="card-job-top--info-heading"><a
                                                        href="{{ route('job.inner', ['id' => $val->id]) }}">{{ $val->title }}</a>
                                                </h6>
                                                <div class="row">
                                                    <div class="col-lg-7">
                                                        <a href="employers-grid.html"><span
                                                                class="card-job-top--company">{{ $val->company }}</span></a>
                                                        <span class="card-job-top--location text-sm"><i
                                                                class="fi-rr-marker"></i>
                                                            {{ $val->location }}</span>
                                                        <span class="card-job-top--type-job text-sm"><i
                                                                class="fi-rr-briefcase"></i>
                                                            {{ $val->job_type }}</span>
                                                        <span class="card-job-top--post-time text-sm"><i
                                                                class="fi-rr-clock"></i> {{ $val->created_at_ago }}</span>
                                                    </div>
                                                    <div class="col-lg-5 text-lg-end">
                                                        <span class="card-job-top--price">{{ $val->salary }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-job-description mt-20">
                                            @php
                                                $shortDesc = isset($data->short_desc)
                                                    ? unserialize($data->short_desc)
                                                    : '';
                                                $limitedShortDesc = Illuminate\Support\Str::words(
                                                    $shortDesc,
                                                    35,
                                                    '...',
                                                );
                                            @endphp
                                            {{ $limitedShortDesc }}
                                        </div>
                                        <div class="card-job-bottom mt-25">
                                            <div class="row">
                                                <div class="col-lg-9 col-sm-8 col-12">
                                                    @if ($val->is_urgent == 1)
                                                        <a href="#"
                                                            class="btn btn-small background-urgent btn-pink mr-5">Urgent</a>
                                                    @endif
                                                    <a href="#"
                                                        class="btn btn-small background-6 disc-btn">{{ $val->job_type }}</a>
                                                </div>
                                                <div class="col-lg-3 col-sm-4 col-12 text-end">
                                                    <span><img
                                                            src="{{ url('public/assets/imgs/theme/icons/shield-check.svg') }}"
                                                            alt="jobhub" /></span>
                                                    <span class="ml-5"><img
                                                            src="{{ url('public/assets/imgs/theme/icons/bookmark.svg') }}"
                                                            alt="jobhub" /></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="mb-20">
                                    <a href="job-grid.html" class="btn btn-default">Explore more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
                        <div class="sidebar-shadow">
                            <div class="sidebar-heading">
                                <div class="avatar-sidebar">
                                    <figure><img alt="jobhub" src="{{ $data->company_logo_link }}" /></figure>
                                    <div class="sidebar-info">
                                        <span class="sidebar-company">{{ $data->company }}</span>
                                        <span class="sidebar-website-text">{{ $data->domain }}</span>
                                        <div class="dropdowm">
                                            <button class="btn btn-dots btn-dots-abs-right dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false"></button>
                                            <ul class="dropdown-menu dropdown-menu-light">
                                                <li><a class="dropdown-item" href="#">Contact</a></li>
                                                <li><a class="dropdown-item" href="#">Bookmark</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-description mt-15">
                                @php
                                    $shortDesc = isset($data->short_desc) ? unserialize($data->short_desc) : '';
                                    $limitedShortDesc = Illuminate\Support\Str::words($shortDesc, 10, '...');
                                @endphp
                                {{ $limitedShortDesc }}
                            </div>
                            <div class="text-start mt-20">
                                @if (Auth::check())
                                    @php
                                        $user = Auth::user();
                                        $canApply = false;
                                        if (!empty($user->subscription_plan)) {
                                            $order = \App\Models\Order::where('user_id', $user->id)
                                                ->where('subscription_box', $user->subscription_plan)
                                                ->where('status', 'completed')
                                                ->latest('order_date')
                                                ->first();

                                            if ($order) {
                                                $subscriptionPlan = $user->subscription_plan;
                                                $orderDate = \Carbon\Carbon::parse($order->order_date);
                                                $today = \Carbon\Carbon::now();

                                                if ($subscriptionPlan === 'Standard') {
                                                    $canApply = $today->lessThanOrEqualTo($orderDate->addDays(14));
                                                } elseif ($subscriptionPlan === 'Premium') {
                                                    $canApply = $today->lessThanOrEqualTo($orderDate->addYear());
                                                } elseif ($subscriptionPlan === 'Enterprise') {
                                                    $canApply = $today->lessThanOrEqualTo($orderDate->addMonths(3));
                                                }
                                            }
                                        }
                                    @endphp

                                    @if ($canApply)
                                        <a href="{{ route('jobApplication', ['id' => $data->id]) }}"
                                            class="btn btn-default mr-15">Apply now</a>
                                    @else
                                        <a href="#" class="btn btn-default mr-15 disabled" aria-disabled="true"
                                            tabindex="-1">Apply now</a>
                                    @endif
                                @else
                                    <a href="#" class="btn btn-default mr-15 disabled" aria-disabled="true"
                                        tabindex="-1">Apply now</a>
                                @endif
                            </div>
                            <div class="sidebar-list-job">
                                <ul>
                                    <li>
                                        <div class="sidebar-icon-item"><i class="fi-rr-briefcase"></i></div>
                                        <div class="sidebar-text-info">
                                            <span class="text-description">Job Type</span>
                                            <strong class="small-heading">{{ $data->job_type }} /
                                                {{ $data->job_type2 }}</strong>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-icon-item"><i class="fa-solid fa-list"></i></div>
                                        <div class="sidebar-text-info">
                                            <span class="text-description">Job Grading</span>
                                            <strong class="small-heading">{{ $data->jobClass->class }}</strong>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-icon-item"><i class="fi-rr-briefcase"></i></div>
                                        <div class="sidebar-text-info">
                                            <span class="text-description">Experience Level</span>
                                            <strong class="small-heading">{{ $data->experience_level }} /
                                                {{ $data->experience_level2 }}</strong>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-icon-item"><i class="fi-rr-marker"></i></div>
                                        <div class="sidebar-text-info">
                                            <span class="text-description">Location</span>
                                            <strong class="small-heading">{{ $data->location }}</strong>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-icon-item"><i class="fi-rr-dollar"></i></div>
                                        <div class="sidebar-text-info">
                                            <span class="text-description">Salary</span>
                                            <strong class="small-heading">{{ $data->salary }}</strong>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-icon-item"><i class="fi-rr-clock"></i></div>
                                        <div class="sidebar-text-info">
                                            <span class="text-description">Date posted</span>
                                            <strong class="small-heading">{{ $data->created_at_ago }}</strong>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-icon-item"><i class="fi-rr-time-fast"></i></div>
                                        <div class="sidebar-text-info">
                                            <span class="text-description">Expiration date</span>
                                            <strong class="small-heading">{{ $data->end_format }}</strong>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="sidebar-team-member pt-40">
                                <h6 class="small-heading">Contact Info</h6>
                                <div class="info-address">
                                    <span><i class="fi-rr-marker"></i> <span>{{ $data->address }}</span></span>
                                    <span><i class="fi-rr-headset"></i> <span>{{ $data->number }}</span></span>
                                    <span><i class="fi-rr-paper-plane"></i> <span>{{ $data->email }}</span></span>
                                    <span><i class="fi-rr-time-fast"></i> <span>{{ $data->time_slot }} </span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('front.subscribe')
    </main>
    <!-- End Content -->
@endsection
