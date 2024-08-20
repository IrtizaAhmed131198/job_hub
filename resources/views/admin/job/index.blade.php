@extends('admin.layout.layout')
@section('content')
@section('title', $title)
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="data_table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Company</th>
                                <th>Location</th>
                                <th>Salary</th>
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
                                <th>Company</th>
                                <th>Location</th>
                                <th>Salary</th>
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
    var jobColumns = [
        { data: 'id', name: 'id' },
        { data: 'title', name: 'title' },
        { data: 'company', name: 'company' },
        { data: 'location', name: 'location' },
        { data: 'salary', name: 'salary' },
        { data: 'image', name: 'image' },
        { data: 'action', name: 'action', orderable: false, searchable: false },
    ];
    initializeDataTable("{{ route('job.getJobs') }}", jobColumns);
</script>
@endsection

@endsection
