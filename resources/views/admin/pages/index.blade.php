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
                  <th>Title</th>
                  <th>Sub Title</th>
                  <th>Banner Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
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
  var userColumns = [{
      data: 'id',
      name: 'id'
    }, // Replace 'column1' with your actual column names
    {
      data: 'title',
      name: 'title'
    },
    {
      data: 'sub_title',
      name: 'sub_title'
    },
    {
      data: 'banner_image',
      name: 'banner_image'
    },
    {
      data: 'action',
      name: 'action',
      orderable: true,
      searchable: true
    },
  ];
  initializeDataTable("{{ route('pages.index') }}", userColumns);
</script>
@endsection

@endsection