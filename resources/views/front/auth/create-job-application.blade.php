@extends('front.layout.layout')
@section('content')
    <!-- Content -->
    <main class="main">
        <section class="section-box">
            <div class="container pt-50">
                <div class="w-50 w-md-100 mx-auto text-center">
                    <h1 class="section-title-large mb-30 wow animate__animated animate__fadeInUp">Job Application</h1>
                    <p class="mb-30 text-muted wow animate__animated animate__fadeInUp font-md">Submit your application job service</p>
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
                                <form class="contact-form-style mt-80" action="{{ route('jobs.apply.create', $job->id) }}" method="POST" enctype="multipart/form-data" id="jobApplicationForm">
                                    @csrf
                                    <input type="hidden" name="action" id="formAction" value="">
                                    <div class="row wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                                        <div class="col-lg-12 col-md-12">
                                            <label for="years_of_experience">Years of Experience</label>
                                            <div class="input-style mb-20">
                                                <input type="number" id="years_of_experience" name="years_of_experience" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <label for="education_level">Education Level</label>
                                            <div class="input-style mb-20">
                                                <input type="text" class="form-control" id="education_level" name="education_level" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <label for="skype_id">Skype ID</label>
                                            <div class="input-style mb-20">
                                                <input type="text" class="form-control" id="skype_id" name="skype_id" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <label for="contact_for_other_roles">Can we contact you for another role?</label>
                                            <div class="input-style mb-20">
                                                <select class="form-control" id="contact_for_other_roles" name="contact_for_other_roles" required>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <label for="skype_id">Languages Spoken</label>
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="languages[]" required>
                                                <button type="button" class="btn btn-danger btn-remove" onclick="removeLanguageField(this)">Remove</button>
                                            </div>
                                            <button type="button" class="btn btn-secondary" onclick="addLanguageField()">Add More</button>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <label for="cv">Upload CV (max 3 pages)</label>
                                            <div class="input-style mb-20">
                                                <input type="file" class="form-control-file" id="cv" name="cv" required>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <button type="submit" class="btn btn-default btn-shadow hover-up" onclick="setFormAction('submit')">Submit and Pay</button>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <button type="button" class="btn btn-default btn-shadow hover-up" onclick="setFormAction('save')">Save</button>
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

@section('script')
<script>
    function setFormAction(action) {
        document.getElementById('formAction').value = action;
        document.getElementById('jobApplicationForm').submit();
    }
    function addLanguageField() {
        const wrapper = document.getElementById('languagesWrapper');
        const div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `
            <input type="text" class="form-control" name="languages[]" required>
            <button type="button" class="btn btn-danger btn-remove" onclick="removeLanguageField(this)">Remove</button>
        `;
        wrapper.insertBefore(div, wrapper.lastElementChild);
    }

    function removeLanguageField(button) {
        button.parentElement.remove();
    }
</script>
@endsection
