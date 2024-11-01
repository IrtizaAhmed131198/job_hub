@extends('admin.layout.layout')
@section('content')
@section('title', Posts)
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Post</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>$error</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('post.update') }}" id="editPostForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="card-body row">
                           <div class="form-group col-md-6">
                                <label for="id">Id</label>
                                <input type="text" name="id" class="form-control" id="id" placeholder="Enter Id" value="{{ $data->id ?? '' }}">
                            </div><div class="form-group col-md-6">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title" value="{{ $data->title ?? '' }}">
                            </div><div class="form-group col-md-12">
                                <label for="content">Content</label>
                                <textarea name="content" class="form-control" id="content" rows="5" placeholder="Enter Content">{{ $data->content ?? '' }}</textarea>
                            </div><div class="form-group col-md-6">
                                <label for="image">Image</label>
                                <input type="text" name="image" class="form-control" id="image" placeholder="Enter Image" value="{{ $data->image ?? '' }}">
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
<!-- No additional script needed -->
@endsection
