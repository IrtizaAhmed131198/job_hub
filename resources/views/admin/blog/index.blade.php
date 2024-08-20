@extends('admin.layout.layout')
@section('content')
@section('title', $title)
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            {{-- <div class="card-header">
              <h3 class="card-title">List Blog Posts</h3>
            </div> --}}
            <!-- /.card-header -->
            <div class="card-body">
              <table id="data_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Author</th>
                  <th>Published At</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Author</th>
                  <th>Published At</th>
                  <th>Image</th>
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
    var blogColumns = [
        { data: 'id', name: 'id' },
        { data: 'title', name: 'title' },
        { data: 'author', name: 'author' },
        { data: 'published_at', name: 'published_at' },
        { data: 'image', name: 'image' },
        { data: 'action', name: 'action', orderable: false, searchable: false },
    ];
    initializeDataTable("{{ route('blog.getBlogs') }}", blogColumns);
</script>
@endsection

@endsection
