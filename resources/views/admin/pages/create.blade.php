@extends('admin.layout.layout')
@section('content')
@section('title' , $title)
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Create User Details</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="card-body row">
              <div class="form-group col-md-6">
                <label for="exampleInputName">Name</label>
                <input type="text" name="title" class="form-control" id="exampleInputName" placeholder="Enter first name">
              </div>
              <div class="form-group col-md-6">
                <label for="exampleInputEmail">sub_title</label>
                <input type="text" name="sub_title" class="form-control" id="exampleInputEmail" placeholder="Enter email">
              </div>
              <div class="form-group col-md-6">
                <label for="exampleInputPassword">short_description</label>
                <textarea name="short_description" class="form-control"></textarea>
              </div>
              <div class="form-group col-md-6">
                <label for="exampleInputPassword">image</label>
                <input type="file" name="image" class="form-control" id="exampleInputEmail" placeholder="Enter email">
              </div>

              <div class="form-group col-md-6">
                <label for="exampleInputCountry">Type</label>
                <select name="page_type" class="form-control">
                  <option value="">--Select page_type--</option>
                  <option value="about_section1">about_section1</option>
                  <option value="about_section2">about_section2</option>
                  <option value="privacy_policy">privacy_policy</option>
                  <option value="terms_of_use">terms_of_use</option>
                </select>
              </div>

            </div>
            <div class="card-body row">
              <div class="form-group col-md-12">
                <label for="exampleInputName">Long Description</label>
                <textarea name="long_description" class="form-control"></textarea>
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
<!-- Add this script in your HTML body section -->

@endsection
@section('script')
<script>
  $(document).ready(function() {
    CKEDITOR.replace('long_description');
    // Hide the company name field initially
    $('#companyNameField').hide();

    // Listen for changes in the role dropdown
    $('select[name="role_id"]').on('change', function() {
      var selectedRoleId = $(this).val();

      // Show/hide the company name field based on the selected role
      if (selectedRoleId === '2') {
        $('#companyNameField').show();
      } else {
        $('#companyNameField').hide();
      }
    });
  });
</script>
@endsection