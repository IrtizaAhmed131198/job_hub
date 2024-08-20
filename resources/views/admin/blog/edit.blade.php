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
                        <h3 class="card-title">Edit Blog Post</h3>
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
                    <form action="{{ route('blog.update') }}" id="editBlogForm" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="card-body row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputTitle">Title</label>
                                <input type="text" name="title" class="form-control" id="exampleInputTitle"
                                    placeholder="Enter title" value="{{ $data->title }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputAuthor">Author</label>
                                <input type="text" name="author" class="form-control" id="exampleInputAuthor"
                                    placeholder="Enter author" value="{{ $data->author }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputContent">Content</label>
                                <textarea name="content" class="form-control" id="exampleInputContent" rows="5" placeholder="Enter content">{{ $data->content }}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputPublishedAt">Published At</label>
                                <input type="datetime-local" name="published_at" class="form-control"
                                    id="exampleInputPublishedAt"
                                    value="{{ $data->published_at ? \Carbon\Carbon::parse($data->published_at)->format('Y-m-d\TH:i') : '' }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputImage">Image</label>
                                <input type="file" name="image" class="form-control" id="exampleInputImage">
                                @if ($data->image)
                                    <input type="hidden" name="hidden_image" value="{{ $data->image }}">
                                    <div class="mt-2">
                                        <img src="{{ asset($data->image) }}" alt="Blog Post Image" width="100">
                                    </div>
                                @endif
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
