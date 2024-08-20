@extends('admin.layout.layout')
@section('content')
@section('title' , $title)
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <form action="{{ route('home.update') }}" id="updateContentForm" method="POST">
              @csrf
              <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
              <div class="card-body row">
                <div class="form-group col-md-12">
                  <label for="exampleInputName">Long Description</label>
                  <textarea name="long_description" class="form-control"></textarea>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-custom">Create</button>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
          </form>
        </div>
      </div>
    </section>
    <!-- /.content -->
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
@endsection
