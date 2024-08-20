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
            <form action="{{ route('users.update') }}" id="createProfileForm" method="POST">
                @csrf
                <div class="card-body row">
                  <div class="form-group col-md-6">
                    <label for="exampleInputName">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputName" value="{{$data->name ?? ''}}" placeholder="Enter first name" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail" placeholder="Enter email" required value="{{$data->email ?? ''}}">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="New password">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPhoneNumber">Phone Number</label>
                    <input type="number" name="phone_number" class="form-control" id="exampleInputPhoneNumber" placeholder="Enter phone number" required value="{{$data->phone_number ?? ''}}">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputDOB">Date of Birth</label>
                    <input type="date" name="dob" class="form-control" id="exampleInputDOB" placeholder="Enter DOB" value="{{$data->dob ?? ''}}" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputCountry">Country</label>
                    <input type="text" name="country" class="form-control" id="exampleInputCountry" value="{{$data->country ?? ''}}">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputCountry">State</label>
                    <input type="text" name="state" class="form-control" id="exampleInputCountry" value="{{$data->state ?? ''}}">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputCity">City</label>
                    <input type="text" name="city" class="form-control" id="exampleInputCity" value="{{$data->city ?? ''}}">
                  </div>
                  <?php $roles = ['2' => 'Company' , '3' => 'Employee']; ?>
                  <input type="hidden" name="id" value="{{$data->id}}">
                  <div class="form-group col-md-6">
                    <label for="exampleInputCountry">Role</label>
                    <select name="role_id" class="form-control">
                      <option value="" >--Select Role--</option>
                      @foreach ($roles as $key => $val)
                        @if ($key === $data->role_id)
                          <option value="{{$key}}" selected>{{$val}}</option>  
                        @else
                          <option value="{{$key}}" >{{$val}}</option>  
                        @endif
                        
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-6" id="companyNameField">
                    <label for="exampleInputCompany">Company Name</label>
                    <input type="text" name="company_name" class="form-control" id="exampleInputCompany" value="{{$data->company_name ?? ''}}">
                  </div>
                </div>
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
    $(document).ready(function () {
        // Show the company name field if "Company" is selected by default
        if ($('select[name="role_id"]').val() === '2') {
            $('#companyNameField').show();
        } else {
            $('#companyNameField').hide();
        }

        // Listen for changes in the role dropdown
        $('select[name="role_id"]').on('change', function () {
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
