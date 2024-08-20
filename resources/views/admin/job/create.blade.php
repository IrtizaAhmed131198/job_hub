@extends('admin.layout.layout')
@section('content')
@section('title', $title)
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Job Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('job.store') }}" id="createJobForm" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body row">
                            <div class="form-group col-md-6">
                                <label for="category_id">Category</label>
                                <select name="category_id" class="form-control" id="category_id" required>
                                    <option value="" selected disabled>---Select---</option>
                                    @foreach($categories as $val)
                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                    @endforeach
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6" id="newCategoryFields" style="display: none;">
                                <label for="new_category_name">New Category Name</label>
                                <input type="text" name="new_category_name" class="form-control" id="new_category_name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title"
                                    placeholder="Enter job title" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="class_id">Grading</label>
                                <select name="class_id" class="form-control" id="class_id">
                                    <option value="">Select Class</option>
                                    @foreach ($job_class as $val)
                                        <option value="{{ $val->id }}">{{ $val->class }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="short_desc">Short Description</label>
                                <textarea name="short_desc" class="form-control" id="short_desc"
                                    placeholder="Enter Short Description"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="company">Company</label>
                                <input type="text" name="company" class="form-control" id="company"
                                    placeholder="Enter company name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="company_logo">Company Logo</label>
                                <input type="file" name="company_logo" class="form-control" id="company_logo" placeholder="https://www.example.com/">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="company_web_link">Company Web Link</label>
                                <input type="text" name="company_web_link" class="form-control" id="company_web_link"
                                    placeholder="Enter company web link">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="location">Location</label>
                                <input type="text" name="location" class="form-control" id="location"
                                    placeholder="Enter job location">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="salary">Salary</label>
                                <select name="salary" class="form-control" id="salary">
                                    <option value="">Select Salary Range</option>
                                    <option value="$30k - $40k" >$30k - $40k</option>
                                    <option value="$35k - $45k" >$35k - $45k</option>
                                    <option value="$40k - $50k" >$40k - $50k</option>
                                    <option value="$45k - $55k" >$45k - $55k</option>
                                    <option value="$50k - $60k" >$50k - $60k</option>
                                    <option value="$55k - $65k" >$55k - $65k</option>
                                    <option value="$60k - $70k" >$60k - $70k</option>
                                    <option value="$65k - $75k" >$65k - $75k</option>
                                    <option value="$70k - $80k" >$70k - $80k</option>
                                    <option value="$75k - $85k" >$75k - $85k</option>
                                    <option value="$80k - $90k" >$80k - $90k</option>
                                    <option value="$85k - $95k" >$85k - $95k</option>
                                    <option value="$90k - $100k" >$90k - $100k</option>
                                    <option value="$100k - $110k" >100k - $110k</option>
                                    <option value="$110k - $120k" >110k - $120k</option>
                                    <option value="$120k - $130k" >120k - $130k</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" class="form-control" id="start_date">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" class="form-control" id="end_date" min="">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description">Description</label>
                                <textarea name="description" class="summernote" id="description" placeholder="Enter job description"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="image">Job Image</label>
                                <input type="file" name="image" class="form-control" id="image">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="experience_level">Experience Level</label>
                                <select name="experience_level" class="form-control" id="experience_level">
                                    <option value="">Select Experience Level</option>
                                    <option value="Expert" >Expert</option>
                                    <option value="Senior" >Senior</option>
                                    <option value="Junior" >Junior</option>
                                    <option value="Regular" >Regular</option>
                                    <option value="Internship" >Internship</option>
                                    <option value="Associate" >Associate</option>
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <input type="hidden" name="is_remote" value="0">
                                <div class="form-check">
                                    <input type="checkbox" name="is_remote" class="form-check-input" id="is_remote" value="1" {{ old('is_remote') ? 'checked' : '' }}>
                                    <label for="is_remote">Is Remote</label>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <input type="hidden" name="is_fulltime" value="0">
                                <div class="form-check">
                                    <input type="checkbox" name="is_fulltime" class="form-check-input"
                                        id="is_fulltime" value="1" {{ old('is_fulltime') ? 'checked' : '' }}>
                                    <label for="is_fulltime">Is Fulltime</label>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <input type="hidden" name="is_urgent" value="0">
                                <div class="form-check">
                                    <input type="checkbox" name="is_urgent" class="form-check-input"
                                        id="is_urgent" value="1" {{ old('is_urgent') ? 'checked' : '' }}>
                                    <label for="is_urgent">Is Urgent</label>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <input type="hidden" name="is_active" value="0">
                                <div class="form-check">
                                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                                    <label for="is_active">Is Active</label>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <input type="hidden" name="is_feature" value="0">
                                <div class="form-check">
                                    <input type="checkbox" name="is_feature" class="form-check-input" id="is_feature" value="" {{ old('is_feature') ? 'checked' : '' }}>
                                    <label for="is_feature">Is Featured</label>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <h4>Contact Info</h4>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" id="address"
                                    placeholder="Enter address">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="number">Contact Number</label>
                                <input type="text" name="number" class="form-control" id="number"
                                    placeholder="Enter contact number">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Enter email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="time_slot">Time Slot</label>
                                <input type="text" name="time_slot" class="form-control" id="time_slot"
                                    placeholder="Enter time slot">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-custom">Create</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category_id');
        const newCategoryFields = document.getElementById('newCategoryFields');
        const newCategoryInput = document.getElementById('new_category_name');

        categorySelect.addEventListener('change', function() {
            if (categorySelect.value === 'other') {
                newCategoryFields.style.display = 'block';
                newCategoryInput.setAttribute('required', 'required');
            } else {
                newCategoryFields.style.display = 'none';
                newCategoryInput.removeAttribute('required');
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');

        // Set minimum date for start date to today's date
        const today = new Date();
        const dd = String(today.getDate()).padStart(2, '0');
        const mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
        const yyyy = today.getFullYear();
        const minDate = `${yyyy}-${mm}-${dd}`;
        startDateInput.setAttribute('min', minDate);

        // Event listener for start date change
        startDateInput.addEventListener('change', function() {
            const selectedStartDate = startDateInput.value;

            // Update minimum date for end date to selected start date
            endDateInput.setAttribute('min', selectedStartDate);

            // Reset end date if it's before the new minimum date
            if (endDateInput.value < selectedStartDate) {
                endDateInput.value = selectedStartDate;
            }
        });

        // Event listener for end date change
        endDateInput.addEventListener('change', function() {
            const selectedEndDate = endDateInput.value;
            const selectedStartDate = startDateInput.value;

            // Ensure end date is not before start date
            if (selectedEndDate < selectedStartDate) {
                endDateInput.value = selectedStartDate;
            }
        });
    });
</script>

@endsection
