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
                        <h3 class="card-title">Update Settings</h3>
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
                    <form action="{{ route('settings.update') }}" id="updateSetForm" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                        <div class="card-body row">
                            <div class="form-group col-md-6">
                                <label for="facebook">Facebook</label>
                                <input type="text" name="facebook" value="{{ $data->facebook ?? '' }}" class="form-control" id="facebook" placeholder="Enter Facebook URL">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="instagram">Instagram</label>
                                <input type="text" name="instagram" value="{{ $data->instagram ?? '' }}" class="form-control" id="instagram" placeholder="Enter Instagram URL">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="twitter">Twitter</label>
                                <input type="text" name="twitter" value="{{ $data->twitter ?? '' }}" class="form-control" id="twitter" placeholder="Enter Twitter URL">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pinterest">Pinterest</label>
                                <input type="text" name="pinterest" value="{{ $data->pinterest ?? '' }}" class="form-control" id="pinterest" placeholder="Enter Pinterest URL">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="youtube">YouTube</label>
                                <input type="text" name="youtube" value="{{ $data->youtube ?? '' }}" class="form-control" id="youtube" placeholder="Enter YouTube URL">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="rate">Current Exchange Rate (USD to KES)</label>
                                <input type="number" step="0.0001" name="rate" value="{{ $data->rate ?? '' }}" class="form-control" id="rate" placeholder="Enter Rate">
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
