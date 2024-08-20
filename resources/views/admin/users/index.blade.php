@extends('admin.layout.layout')
@section('content')
@section('title' , $title)
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            {{-- <div class="card-header">
              <h3 class="card-title">List Users </h3>
            </div> --}}
            <!-- /.card-header -->
            <div class="card-body">
              <table id="data_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Role</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Country</th>
                  <th>Postal Code</th>
                  <th>City</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Country</th>
                    <th>Postal Code</th>
                    <th>City</th>
                    <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>

    @section('script')
    <script>
        var userColumns = [
            { data: 'id', name: 'id' }, // Replace 'column1' with your actual column names
            { data: 'name', name: 'name' },
            { data: 'role.name', name: 'role_name' },
            { data: 'email', name: 'email' },
            { data: 'mobile_number', name: 'mobile_number' },
            { data: 'country', name: 'country' },
            { data: 'postal_code', name: 'postal_code' },
            { data: 'city', name: 'city' },
            { data: 'action', name: 'action', orderable: true, searchable: true },
        ];
        initializeDataTable("{{ route('users.getUsers') }}", userColumns);
    </script>
    @endsection

  @endsection
