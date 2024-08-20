@if ($grid != 'grid')
    @foreach($jobs as $job)
    <div class="col-lg-4 col-md-6">
        <div class="card-grid-2 hover-up wow animate__animated animate__fadeIn" data-wow-delay=".0s">
            <div class="jobClass"><span>{{ $job->jobClass->class}}</span></div>
            <div class="text-center card-grid-2-image">
                <a href="{{ route('job.inner', ['id' => $job->id]) }}">
                    <figure><img alt="jobhub" src="{{ asset('public/' . $job->image) }}" /></figure>
                </a>
                @if ($job->is_urgent)
                    <label class="btn-urgent">Urgent</label>
                @endif
            </div>
            <div class="card-block-info">
                <div class="row">
                    <div class="col-lg-7 col-6">
                        <a href="employers-single.html" class="card-2-img-text">
                            <span class="card-grid-2-img-small"><img alt="jobhub" src="{{ asset('public/' . $job->company_logo) }}" /></span>
                            <span>{{ $job->company }}</span>
                        </a>
                    </div>
                    <div class="col-lg-5 col-6 text-end">
                        @if ($job->is_fulltime)
                            <span class="btn btn-grey-small disc-btn">Full time</span>
                        @else
                            <span class="btn btn-grey-small disc-btn">Part time</span>
                        @endif
                    </div>
                </div>
                <h5 class="mt-20"><a href="{{ route('job.inner', ['id' => $job->id]) }}">{{ $job->title }}</a></h5>
                <div class="mt-15">
                    <span class="card-time">{{ $job->created_at->diffForHumans() }}</span>
                    <span class="card-location">{{ $job->location }}</span>
                </div>
                <div class="card-2-bottom mt-30">
                    <div class="row">
                        <div class="col-lg-7 col-8">
                            <span class="card-text-price"> {{ $job->salary }}</span>
                        </div>
                        <div class="col-lg-5 col-4 text-end">
                            <span><img alt="jobhub" src="{{ url('public/assets/imgs/theme/icons/shield-check.svg') }}" /></span>
                            <span class="ml-5"><img alt="jobhub" src="{{ url('public/assets/imgs/theme/icons/bookmark.svg') }}" /></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="paginations">
        {{ $jobs->links() }}
    </div>
@else
    <div class="job-list-list mb-15">
        <div class="list-recent-jobs">
            @foreach($jobs as $job)
            <div class="card-job hover-up wow animate__animated animate__fadeIn">
                <div class="card-job-top">
                    <div class="card-job-top--image">
                        <figure><img alt="jobhub" src="{{ asset('public/' . $job->image) }}" /></figure>
                    </div>
                    <div class="card-job-top--info">
                        <h6 class="card-job-top--info-heading"><a href="{{ route('job.inner', ['id' => $job->id]) }}">{{ $job->title }}</a></h6>
                        <div class="row">
                            <div class="col-lg-7">
                                <a href="#"> <a href="#"><span class="card-job-top--company">{{ $job->company}}</span></a></a>
                                <span class="card-job-top--location text-sm"><i class="fi-rr-marker"></i> {{ $job->location }}</span>
                                <span class="card-job-top--post-time text-sm"><i class="fi-rr-clock"></i> {{ $job->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-5 text-lg-end">
                                <span class="card-job-top--price">{{ $job->salary }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-job-description mt-20">
                    @php
                        $shortDesc = isset($job->short_desc) ? unserialize($job->short_desc) : "";
                        $limitedShortDesc = Illuminate\Support\Str::words($shortDesc, 35, '...');
                    @endphp
                    {{ $limitedShortDesc }}
                </div>
                <div class="card-job-bottom mt-25">
                    <div class="row">
                        <div class="col-lg-9 col-sm-8 col-12">
                            @if ($job->is_urgent)
                                <a href="#" class="btn btn-small background-urgent btn-pink mr-5">Urgent</a>
                            @endif
                            @if ($job->is_fulltime)
                                <a href="#" class="btn btn-small background-6 disc-btn">Full time</a>
                            @else
                                <a href="#" class="btn btn-small background-6 disc-btn">Part time</a>
                            @endif
                        </div>
                        <div class="col-lg-3 col-sm-4 col-12 text-lg-end d-lg-block d-none">
                            <span><img src="{{ url('public/assets/imgs/theme/icons/shield-check.svg') }}" alt="jobhub"></span>
                            <span class="ml-5"><img src="{{ url('public/assets/imgs/theme/icons/bookmark.svg') }}" alt="jobhub"></span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="paginations">
        {{ $jobs->links() }}
    </div>

@endif

<style>
    .paginations .pager li a.active {
        font-weight: bold !important;
    }
    .paginations .pager li a.pager-number.active::before {
        content: "" !important;
        height: 28px !important;
        width: 28px !important;
        background: #9777fa !important;
        opacity: 0.3 !important;
        border-radius: 8px !important;
        position: absolute !important;
        z-index: -1 !important;
        top: 8px !important;
        left: -1px !important;
    }
    .paginations .pager li a.pager-number:hover::before {
        content: "" !important;
        height: 28px !important;
        width: 28px !important;
        background: #9777fa !important;
        opacity: 0.3 !important;
        border-radius: 8px !important;
        position: absolute !important;
        z-index: -1 !important;
        top: 8px !important;
        left: -1px !important;
    }
</style>
