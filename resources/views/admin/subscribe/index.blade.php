@extends('admin.layout.layout')
@section('content')
@section('title' , $title)
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            {{-- <div class="card-header">
              <h3 class="card-title">List Partners</h3>
            </div> --}}
            <!-- /.card-header -->
            <div class="card-body">
              <table id="data_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
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
    var subscribeColumns = [
        { data: 'id', name: 'id' },
        { data: 'email', name: 'email' },
        { data: 'action', name: 'action', orderable: false, searchable: false },
    ];
    initializeDataTable("{{ route('subscribe.getSubscribe') }}", subscribeColumns);
</script>
@endsection

@endsection
