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
                        <h3 class="card-title">Create Blog Post</h3>
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
                    <form action="{{ route('blog.store') }}" id="createBlogForm" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputTitle">Title</label>
                                <input type="text" name="title" class="form-control" id="exampleInputTitle"
                                    placeholder="Enter title">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputAuthor">Author</label>
                                <input type="text" name="author" class="form-control" id="exampleInputAuthor"
                                    placeholder="Enter author">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputContent">Content</label>
                                <textarea name="content" class="form-control" id="exampleInputContent" rows="5" placeholder="Enter content"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputPublishedAt">Published At</label>
                                <input type="datetime-local" name="published_at" class="form-control"
                                    id="exampleInputPublishedAt">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputImage">Image</label>
                                <input type="file" name="image" class="form-control" id="exampleInputImage">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-custom">Create</button>
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
<!-- No additional script needed as the role functionality has been removed -->
@endsection
