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
            <h3 class="card-title">Update User Details</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{ route('pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body row">
              <div class="form-group col-md-6" id="page_title">
                <label for="exampleInputName">Title</label>
                <input type="text" name="title" class="form-control" value="{{$page->title ?? ''}}" placeholder="Enter title" required>
              </div>
              @if($page->page_type == "about_section1" || $page->page_type == "about_section2" || $page->page_type == "home2")
              <div class="form-group col-md-6" id="sub_title">
                <label for="exampleInputEmail">Sub Title</label>
                <input type="text" name="sub_title" class="form-control" placeholder="Enter sub title" value="{{$page->sub_title ?? ''}}">
              </div>
              @endif
            </div>
            @if($page->page_type == "about_section1" || $page->page_type == "about_section2" || $page->page_type == "footer" || $page->page_type == "home2")
            <div class="card-body row">
              <div class="form-group col-md-12" id="short_description">
                <label>Short Description</label>
                <textarea name="short_description" class="form-control">{{$page->short_description ?? ''}}</textarea>
              </div>
            </div>
            @endif

            {{-- @if($page->page_type == "about_section1" || $page->page_type == "about_section2" || $page->page_type == "about_section2")
            <div class="card-body row" id="page_image">
              <div class="form-group col-md-6">
                <label>Page Image</label>
                <input type="file" name="image" id="imageInput" data-preview-id="imagePreview" class="form-control">
              </div>
              <div class="form-group col-md-6">
                @if($page->image)
                <img src="{{ asset('public/'.$page->image) }}" id="imagePreview" alt="Page Image" style="max-width: 200px;max-height:200px;">
                @else
                <img src="" id="imagePreview" alt="Image Preview" style="max-width: 200px;max-height:200px;display:none;">
                @endif
              </div>
            </div>
            @endif --}}
            @if($page->page_type != "footer")
            <div class="card-body row" id="banner_image">
              <div class="form-group col-md-6">
                <label>Banner Image</label>
                <input type="file" name="banner_image" id="bannerInput" data-preview-id="bannerPreview" class="form-control">
              </div>
              <div class="form-group col-md-6">
                @if($page->banner_image)
                <img src="{{ asset('public/'.$page->banner_image) }}" id="bannerPreview" alt="Banner Image" style="max-width: 450px;max-height: 300px;">
                @else
                <img src="" id="bannerPreview" alt="Image Preview" style="max-width: 450px;max-height: 300px;display:none;">
                @endif
              </div>
            </div>
            @endif
            @php
            $long_description = unserialize($page->long_description);
            @endphp
            @if($page->page_type != "footer" && $page->page_type != "home2")
            <div class="card-body row">
              <div class="form-group col-md-12">
                <label for="exampleInputName">Long Description</label>
                <textarea name="long_description" class="summernote">{{$long_description ?? ''}}</textarea>
              </div>
            </div>
            @endif

            @if($page->page_type == "home2")
            <div class="card-body row">
              <div class="form-group col-md-6" id="page_title">
                <label for="exampleInputLink">Link</label>
                <input type="text" name="link" class="form-control" value="{{$page->link ?? ''}}" placeholder="Enter link">
              </div>
            </div>
            @endif

            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary btn-custom">Update</button>
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
  $(document).ready(function() {
    // CKEDITOR.replace('long_description');

    $('#imageInput, #bannerInput').change(function() {
      // Get the selected file
      var file = this.files[0];

      if (file) {
        // Get the ID of the preview area corresponding to the input
        var previewId = $(this).data('preview-id');

        // Create a FileReader object
        var reader = new FileReader();

        // Set up the reader to display the image when it's loaded
        reader.onload = function(e) {
          // Set the source of the corresponding image preview tag to the loaded data URL
          $('#' + previewId).show();
          $('#' + previewId).attr('src', e.target.result);
        };

        // Read the selected file as a data URL
        reader.readAsDataURL(file);
      }
    });

    // Show the company name field if "Company" is selected by default
    if ($('select[name="role_id"]').val() === '2') {
      $('#companyNameField').show();
    } else {
      $('#companyNameField').hide();
    }

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

  $(function () {
      // Summernote
      $('.summernote').summernote({
          height: 300, // set editor height in pixels
          callbacks: {
              onInit: function() {
                  $('.summernote').summernote('code', $('.summernote').val());
              }
          }
      });
  })
</script>
@endsection