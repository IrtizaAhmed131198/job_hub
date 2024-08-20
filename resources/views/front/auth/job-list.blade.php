@extends('front.layout.layout')
@section('content')
    <!-- Content -->
    <main class="main">
        <section class="section-box">
            <div class="container pt-50">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8 text-center">
                        <h1 class="section-title-large mb-30 wow animate__animated animate__fadeInUp">Job List
                        </h1>
                        <h5 class="mb-30 text-muted wow animate__animated animate__fadeInUp"></h5>
                    </div>
                </div>
            </div>
        </section>

        <section class="dashboard-tabs">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="side-table">
                            @include('front.auth.sidebar')
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="maintable">
                            <h3>Order
                                History</h3>

                            <table id="data_table" class="table table-bordered table-striped">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Job Title</th>
                                        <th>Job Class</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- End Content -->
@endsection
@section('script')
<script>
    var jobColumns = [
        { data: 'sno', name: 'sno' },
        { data: 'job_title', name: 'job_title' },
        { data: 'job_class', name: 'job_class' },
        { data: 'action', name: 'action', orderable: false, searchable: false },
    ];

    $(document).ready(function () {
        $('#data_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('jobs.getList') }}", // Replace with the actual route
            columns: jobColumns,
            initComplete: function () {
                console.log(this.api().ajax.json()); // Log the response data
            }
        });
    });
</script>
@endsection
