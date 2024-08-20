@extends('front.layout.layout')
@section('content')
<!-- Content -->
<main class="main">
    <section class="section-box-2">
        <div class="box-head-single none-bg">
            <div class="container">
                <h4>There Are {{ $job_count }} Jobs<br />Here For you!</h4>
                <div class="row mt-15 mb-40">
                    <div class="col-lg-7 col-md-9">
                        <span class="text-mutted">Discover your next career move, freelance gig, or
                            internship</span>
                    </div>
                    <div class="col-lg-5 col-md-3 text-lg-end text-start">
                        <ul class="breadcrumbs mt-sm-15">
                            <li><a href="{{ route('home.index') }}">Home</a></li>
                            <li>Jobs listing</li>
                        </ul>
                    </div>
                </div>
                <div class="box-shadow-bdrd-15 box-filters">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="box-search-job">
                                <form class="form-search-job" id="searchForm">
                                    <input type="text" class="input-search-job" id="searchInput" placeholder="UI Designer" />
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="d-flex job-fillter">
                                <div class="d-block d-lg-flex">
                                    <div class="dropdown job-type">
                                        <button class="btn dropdown-toggle" type="button" id="dropdownJobType1" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true" data-bs-display="static"><i class="fi-rr-briefcase"></i>
                                            <span>Full time</span> <i class="fi-rr-angle-small-down"></i></button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownJobType1">
                                            <li><a class="dropdown-item" href="#" data-text = "full time">Full time</a></li>
                                            <li><a class="dropdown-item" href="#"  data-text = "part time">Part time</a></li>
                                        </ul>
                                    </div>
                                    <div class="dropdown job-type">
                                        <button class="btn dropdown-toggle" type="button" id="dropdownJobType2" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true" data-bs-display="static"><i class="fi-rr-briefcase"></i>
                                            <span>Job Class</span> <i class="fi-rr-angle-small-down"></i></button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownJobType2">
                                            @foreach ($job_class as $item)
                                                <li><a class="dropdown-item" href="#" data-text = "{{ $item->id }}">{{ $item->class }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="dropdown job-type">
                                        <button class="btn dropdown-toggle" type="button" id="dropdownJobType3" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true" data-bs-display="static"><i class="fi-rr-briefcase"></i>
                                            <span>Remote</span> <i class="fi-rr-angle-small-down"></i></button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownJobType3">
                                            <li><a class="dropdown-item" href="#" data-text = "remote">Remote</a></li>
                                            <li><a class="dropdown-item" href="#" data-text = "onsite">Onsite</a></li>
                                        </ul>
                                    </div>
                                    <div class="dropdown location">
                                        <button class="btn dropdown-toggle" type="button" id="dropdownLocation2" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static"><i class="fi-rr-dollar"></i> <span>Salary Range</span> <i class="fi-rr-angle-small-down"></i></button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownLocation2">
                                            <li><a class="dropdown-item" href="#">$30k - $40k</a></li>
                                            <li><a class="dropdown-item" href="#">$35k - $45k</a></li>
                                            <li><a class="dropdown-item" href="#">$40k - $50k</a></li>
                                            <li><a class="dropdown-item" href="#">$45k - $55k</a></li>
                                            <li><a class="dropdown-item" href="#">$50k - $60k</a></li>
                                            <li><a class="dropdown-item" href="#">$55k - $65k</a></li>
                                            <li><a class="dropdown-item" href="#">$60k - $70k</a></li>
                                            <li><a class="dropdown-item" href="#">$65k - $75k</a></li>
                                            <li><a class="dropdown-item" href="#">$70k - $80k</a></li>
                                            <li><a class="dropdown-item" href="#">$75k - $85k</a></li>
                                            <li><a class="dropdown-item" href="#">$80k - $90k</a></li>
                                            <li><a class="dropdown-item" href="#">$85k - $95k</a></li>
                                            <li><a class="dropdown-item" href="#">$90k - $100k</a></li>
                                            <li><a class="dropdown-item" href="#">$100k - $110k</a></li>
                                            <li><a class="dropdown-item" href="#">$110k - $120k</a></li>
                                            <li><a class="dropdown-item" href="#">$120k - $130k</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="box-button-find">
                                    <button class="btn btn-default float-right">Find Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-box mt-80">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9 col-md-12 col-sm-12 col-12 float-right">
                    <div class="content-page">
                        <div class="box-filters-job mt-15 mb-10">
                            <div class="row">
                                <div class="col-lg-7">
                                    {{-- <span class="text-small">Showing <strong>{{ $from }}-{{ $to }}</strong> of <strong>{{ $total }}</strong> jobs</span> --}}
                                </div>
                                <div class="col-lg-5 text-lg-end mt-sm-15">
                                    <div class="display-flex2">
                                        <span class="text-sortby">Sort by:</span>
                                        <div class="dropdown dropdown-sort">
                                            <button class="btn dropdown-toggle" type="button" id="dropdownSort" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">
                                                <span id="sortOption">Newest Post</span> <i class="fi-rr-angle-small-down"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="dropdownSort">
                                                <li><a class="dropdown-item sort-option" data-sort="newest" href="#">Newest Post</a></li>
                                                <li><a class="dropdown-item sort-option" data-sort="oldest" href="#">Oldest Post</a></li>
                                            </ul>
                                        </div>

                                        <div class="box-view-type">
                                            <a href="{{ url('job') }}" class="view-type"><img src="{{ url('public/assets/imgs/theme/icons/icon-list.svg') }}" alt="jobhub" /></a>
                                            <a href="{{ url('job/grid') }}" class="view-type"><img src="{{ url('public/assets/imgs/theme/icons/icon-grid.svg') }}" alt="jobhub" /></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($grid == null)
                            <input type="hidden" name="grid" id="grid" value="list">
                            <div class="row" id="job-list">
                                @include('front.job-list', ['jobs' => $jobs, 'grid' => $grid])
                            </div>
                        @else
                            <input type="hidden" name="grid" id="grid" value="grid">
                            <div id="job-list">
                                @include('front.job-list', ['jobs' => $jobs, 'grid' => $grid])
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="sidebar-with-bg">
                        <h5 class="font-semibold mb-10">Set job reminder</h5>
                        <p class="text-body-999">Enter you email address and get job notification.</p>
                        <div class="box-email-reminder">
                            <form>
                                <div class="form-group mt-15">
                                    <input type="text" class="form-control input-bg-white form-icons" placeholder="Enter email address" />
                                    <i class="fi-rr-envelope"></i>
                                </div>
                                <div class="form-group mt-25 mb-5">
                                    <button class="btn btn-default btn-md">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="sidebar-shadow none-shadow mb-30">
                        <div class="sidebar-filters">
                            <div class="filter-block mb-30">
                                <h5 class="medium-heading mb-15">Location</h5>
                                <div class="form-group">
                                    <input type="text" class="form-control form-icons" placeholder="Location" />
                                    <i class="fi-rr-marker"></i>
                                </div>
                            </div>
                            <div class="filter-block mb-30">
                                <h5 class="medium-heading mb-15">Categoy</h5>
                                <div class="form-group select-style select-style-icon">
                                    <select class="form-control form-icons select-active">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $val)
                                            <option value="{{ $val->id }}">{{ $val->name }}</option>
                                        @endforeach
                                    </select>
                                    <i class="fi-rr-briefcase"></i>
                                </div>
                            </div>
                            <div class="filter-block mb-30" style="display: none">
                                <h5 class="medium-heading mb-15">Job type</h5>
                                <div class="form-group">
                                    <ul class="list-checkbox">
                                        <li>
                                            <label class="cb-container">
                                                <input type="checkbox"> <span class="text-small">Full Time
                                                    Jobs</span>
                                                <span class="checkmark"></span>
                                            </label>
                                            <span class="number-item">{{ $is_fulltime_count }}</span>
                                        </li>
                                        <li>
                                            <label class="cb-container">
                                                <input type="checkbox"> <span class="text-small">Part Time
                                                    Jobs</span>
                                                <span class="checkmark"></span>
                                            </label>
                                            <span class="number-item">{{ $is_partime_count }}</span>
                                        </li>
                                        <li>
                                            <label class="cb-container">
                                                <input type="checkbox"> <span class="text-small">Remote
                                                    Jobs</span>
                                                <span class="checkmark"></span>
                                            </label>
                                            <span class="number-item">{{ $is_remote_count }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="filter-block mb-30">
                                <h5 class="medium-heading mb-10">Experience Level</h5>
                                <div class="form-group">
                                    <ul class="list-checkbox">
                                        <li>
                                            <label class="cb-container">
                                                <input type="checkbox"> <span class="text-small">Expert</span>
                                                <span class="checkmark"></span>
                                            </label>
                                            <span class="number-item">{{ $Expert }}</span>
                                        </li>
                                        <li>
                                            <label class="cb-container">
                                                <input type="checkbox"> <span class="text-small">Senior</span>
                                                <span class="checkmark"></span>
                                            </label>
                                            <span class="number-item">{{ $Senior }}</span>
                                        </li>
                                        <li>
                                            <label class="cb-container">
                                                <input type="checkbox"> <span class="text-small">Junior</span>
                                                <span class="checkmark"></span>
                                            </label>
                                            <span class="number-item">{{ $Junior }}</span>
                                        </li>
                                        <li>
                                            <label class="cb-container">
                                                <input type="checkbox"> <span class="text-small">Regular</span>
                                                <span class="checkmark"></span>
                                            </label>
                                            <span class="number-item">{{ $Regular }}</span>
                                        </li>
                                        <li>
                                            <label class="cb-container">
                                                <input type="checkbox"> <span class="text-small">Internship</span>
                                                <span class="checkmark"></span>
                                            </label>
                                            <span class="number-item">{{ $Internship }}</span>
                                        </li>
                                        <li>
                                            <label class="cb-container">
                                                <input type="checkbox"> <span class="text-small">Associate</span>
                                                <span class="checkmark"></span>
                                            </label>
                                            <span class="number-item">{{ $Associate }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            {{-- <div class="filter-block mb-40">
                                <h5 class="medium-heading mb-25">Salary Range</h5>
                                <div class="">
                                    <div class="row mb-20">
                                        <div class="col-sm-12">
                                            <div id="slider-range"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label class="lb-slider">From</label>
                                            <div class="form-group minus-input">
                                                <input type="text" name="min-value-money" class="input-disabled form-control min-value-money" disabled="disabled" value="" />
                                                <input type="hidden" name="min-value" class="form-control min-value" value="" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="lb-slider">To</label>
                                            <div class="form-group">
                                                <input type="text" name="max-value-money" class="input-disabled form-control max-value-money" disabled="disabled" value="" />
                                                <input type="hidden" name="max-value" class="form-control max-value" value="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="buttons-filter">
                                <button class="btn btn-default">Apply filter</button>
                                <button class="btn" onclick="window.location.href = '{{ route('home.index') }}'">Reset filter</button>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-with-bg background-primary bg-sidebar pb-80">
                        <h5 class="medium-heading text-white mb-20 mt-20">Recruiting?</h5>
                        <p class="text-body-999 text-white mb-30">Advertise your jobs to millions of monthly users
                            and
                            search 16.8 million CVs in our database.</p>
                        <a href="#" class="btn btn-border icon-chevron-right btn-white-sm">Post a Job</a>
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
                        <input type="text" class="input-newsletter" value="" placeholder="contact.alithemes@gmail.com" />
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
@section('script')
<script>
    $(document).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        // Handle search form submission
        $('#searchForm').submit(function(event) {
            event.preventDefault();
            fetchJobs(1);
        });

        // Handle pagination clicks
        $(document).on('click', '.paginations a', function(event) {
            event.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            fetchJobs(page);
        });

        // Handle sorting clicks
        $('.dropdown-item.sort-option').click(function(event) {
            event.preventDefault();
            let sort_by = $(this).data('sort');
            $('#sortOption').text($(this).text());
            fetchJobs(1, sort_by);
        });

        // Handle filter clicks
        $('.dropdown.job-type .dropdown-item').click(function(event) {
            event.preventDefault();
            let $dropdownMenu = $(this).closest('.dropdown-menu');

            // Remove 'active' class from any previously active dropdown item within the same menu
            $dropdownMenu.find('.dropdown-item.active').removeClass('active');

            // Add 'active' class to the clicked dropdown item
            $(this).addClass('active');

            // Update the dropdown button's displayed text with the text of the clicked item
            let $dropdownButton = $dropdownMenu.prev('.dropdown-toggle');
            $dropdownButton.find('span').text($(this).text());

            fetchJobs(1);
        });

        $('.dropdown.location .dropdown-item').click(function(event) {
            event.preventDefault();
            let $dropdownMenu = $(this).closest('.dropdown-menu');

            // Remove 'active' class from any previously active dropdown item within the same menu
            $dropdownMenu.find('.dropdown-item.active').removeClass('active');

            // Add 'active' class to the clicked dropdown item
            $(this).addClass('active');

            // Update the dropdown button's displayed text with the text of the clicked item
            let $dropdownButton = $dropdownMenu.prev('.dropdown-toggle');
            $dropdownButton.find('span').text($(this).text());

            fetchJobs(1);
        });

        // Handle Apply filter button click
        $('.buttons-filter .btn-default').click(function(event) {
            event.preventDefault();
            fetchJobs(1);
        });

        // Fetch jobs function with optional parameters for page and sort
        function fetchJobs(page = 1, sort_by = null) {
            let searchKeyword = $('#searchInput').val().trim();
            let jobType1 =$('#dropdownJobType1').next('.dropdown-menu').find('.dropdown-item.active').data('text');
            let jobType2 = $('#dropdownJobType2').next('.dropdown-menu').find('.dropdown-item.active').data('text');
            let jobType3 = $('#dropdownJobType3').next('.dropdown-menu').find('.dropdown-item.active').data('text');
            let salaryRange = $('#dropdownLocation2').next('.dropdown-menu').find('.dropdown-item.active').text().trim();
            let location = $('input[placeholder="Location"]').val().trim();
            let category = $('.select-active').val().trim();
            let grid = $('#grid').val();

            let jobTypes = [];
            let experienceLevels = [];

            $('.filter-block ul.list-checkbox input[type="checkbox"]:checked').each(function() {
                let label = $(this).next('span').text().trim();
                if ($(this).closest('.filter-block').find('h5').text().trim() === 'Job type') {
                    jobTypes.push(label);
                } else if ($(this).closest('.filter-block').find('h5').text().trim() === 'Experience Level') {
                    experienceLevels.push(label);
                }
            });

            $.ajax({
                url: "{{ route('job.fetch') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                data: {
                    page: page,
                    sort_by: sort_by,
                    search_keyword: searchKeyword,
                    job_type1: jobType1,
                    job_type2: jobType2,
                    job_type3: jobType3,
                    salary_range: salaryRange,
                    location: location,
                    category: category,
                    job_types: jobTypes,
                    experience_levels: experienceLevels,
                    grid: grid
                },
                success: function(data) {
                    $('#job-list').html(data);
                }
            });
        }

        // Initial load
        fetchJobs();
    });

</script>

@endsection
