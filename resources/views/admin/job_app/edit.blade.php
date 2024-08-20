@extends('admin.layout.layout')
@section('content')
@section('title', $title)
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Job Application Status</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('jobapp.update') }}" id="updateJobAppForm" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                        <div class="card-body row">
                            <div class="form-group col-md-6">
                                <label for="exampleNameQuestion">Job Status</label>
                                <select name="job_status" class="form-control" id="job_status">
                                    <option value="">Select Status</option>
                                    <option value="0" {{ $data->id == 0 ? 'selected' : '' }}>Screening</option>
                                    <option value="1" {{ $data->id == 1 ? 'selected' : '' }}>Interview</option>
                                    <option value="2" {{ $data->id == 2 ? 'selected' : '' }}>On Hold</option>
                                    <option value="3" {{ $data->id == 3 ? 'selected' : '' }}>Offer</option>
                                    <option value="4" {{ $data->id == 4 ? 'selected' : '' }}>Rejected</option>
                                </select>
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
                <!-- You can add additional content here if needed -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
