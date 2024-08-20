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
                                <th>Job Title</th>
                                <th>User Name</th>
                                <th>Job Class</th>
                                <th>Payment</th>
                                <th>Payment Status</th>
                                <th>Job Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Job Title</th>
                                <th>User Name</th>
                                <th>Job Class</th>
                                <th>Payment</th>
                                <th>Payment Status</th>
                                <th>Job Status</th>
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
        { data: 'sno', name: 'sno' },
        { data: 'job_title', name: 'job_title' },
        { data: 'user_name', name: 'user_name' },
        { data: 'job_class', name: 'job_class' },
        { data: 'payment_amount', name: 'payment_amount' },
        { data: 'job_status', name: 'job_status' },
        { data: 'action', name: 'action', orderable: false, searchable: false },
    ];
    initializeDataTable("{{ route('jobapp.getJobsApplication') }}", jobColumns);
</script>
@endsection

@endsection
