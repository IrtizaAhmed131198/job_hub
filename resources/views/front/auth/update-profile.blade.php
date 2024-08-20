@extends('front.layout.layout')
@section('content')
    <!-- Content -->
    <style>
        select option[selected] {
            background-color: #007bff; /* Selected option background color */
            color: #fff; /* Selected option text color */
        }

    </style>
    <main class="main">
        <section class="section-box">
            <div class="container pt-50">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8 text-center">
                        <h1 class="section-title-large mb-30 wow animate__animated animate__fadeInUp">Update Profile
                        </h1>
                        <h5 class="mb-30 text-muted wow animate__animated animate__fadeInUp">Tellus praesent
                            vulputate placerat enim donec eget fermentum diam nunc erat commodo ornare eget lorem
                            pharetra sit pharetra</h5>
                    </div>
                </div>
            </div>
        </section>

        <section class="dashboard-tabs">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="side-table">
                            @include('front.auth.sidebar')
                        </div>
                    </div>
                    <div class="col-lg-9">
                        {{-- <div class="maintable">
                                 <h3>Get
                                      Quote</h3>
                            </div> --}}
                        <div class="row">
                            <div class="col-xl-9 col-md-12">
                                <div class="contact-from-area ">
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
                                    <form class="contact-form-style" id="update-form" action="{{ route('postUpdateProfile') }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <div class="row wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="name" placeholder="Your Name" type="text"
                                                        value="{{ old('name', $data->name) }}" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="email" placeholder="Your Email" type="email"
                                                        value="{{ old('email', $data->email) }}" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="password" placeholder="Your Password" type="password" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="mobile_number" placeholder="Mobile Number" type="tel"
                                                        value="{{ old('mobile_number', $data->mobile_number) }}" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="date_of_birth" placeholder="Date of Birth (YYYY-MM-DD)"
                                                        type="date"
                                                        value="{{ old('date_of_birth', $data->date_of_birth) }}" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <select name="gender" class="gender">
                                                        <option value="">Select Gender</option>
                                                        <option value="male"
                                                            {{ old('gender', $data->gender) == 'male' ? 'selected' : '' }}>
                                                            Male</option>
                                                        <option value="female"
                                                            {{ old('gender', $data->gender) == 'female' ? 'selected' : '' }}>
                                                            Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-style mb-20">
                                                    <textarea name="address" placeholder="Address">{{ old('address', $data->address) }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="country" placeholder="Country" type="text"
                                                        value="{{ old('country', $data->country) }}" />
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="city" placeholder="City" type="text"
                                                        value="{{ old('city', $data->city) }}" />
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="postal_code" placeholder="Postal Code" type="text"
                                                        value="{{ old('postal_code', $data->postal_code) }}" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="citizenship" placeholder="Citizenship" type="text"
                                                        value="{{ old('citizenship', $data->citizenship) }}" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="passport_number" placeholder="Passport Number (Optional)"
                                                        type="text"
                                                        value="{{ old('passport_number', $data->passport_number) }}" />
                                                </div>
                                            </div>
                                            <!-- Additional Info Fields -->
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="position" placeholder="Position" type="text"
                                                        value="{{ old('position', $data->additionalInfo->position ?? '') }}" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="charge" placeholder="Charge" type="number" step="any"
                                                        value="{{ old('charge', $data->additionalInfo->charge ?? '') }}" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <label for="skills">Skills:</label>
                                                    <select name="skills[]" id="skills" multiple>
                                                        @foreach ($skills as $skill)
                                                            <option value="{{ $skill->id }}"
                                                                {{ in_array($skill->id, explode(',', $data->additionalInfo->skills ?? '')) ? 'selected' : '' }}>
                                                                {{ $skill->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="input-style mb-20">
                                                    <input name="experience" placeholder="Experience" type="number"
                                                        value="{{ old('experience', $data->additionalInfo->experience ?? '') }}" />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-style mb-20">
                                                    <textarea name="bio" placeholder="Bio">{{ old('bio', $data->additionalInfo->bio ?? '') }}</textarea>
                                                </div>
                                            </div>
                                            <!-- End Additional Info Fields -->

                                            <div class="col-12">
                                                <div class="input-style mb-20">
                                                    <label for="resume">Upload Images:</label>
                                                    <input type="file" name="image" accept="image/*">
                                                </div>
                                                @if ($data->image)
                                                    <input type="hidden" name="hidden_image" value="{{ $data->image }}">
                                                    <div class="mt-2">
                                                        <img src="{{ $data->image_link }}" width="100">
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-12">
                                                <div class="input-style mb-20">
                                                    <label for="resume">Upload Resume:</label>
                                                    <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx,.txt,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                                </div>
                                                @if ($data->additionalInfo->resume)
                                                    <input type="hidden" name="hidden_resume" value="{{ $data->additionalInfo->resume }}">
                                                    <div class="mt-2">
                                                        <a href="{{ $data->additionalInfo->resume_link }}" target="_blank">Download Resume</a>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Update Profile</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- End Content -->
@endsection
