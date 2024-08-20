@extends('admin.layout.layout')
@section('content')
@section('title', $title)
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="data_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('script')
<script>
    var catColumns = [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'action', name: 'action', orderable: true, searchable: true },
    ];
    initializeDataTable("{{ route('categories.getCategories') }}", catColumns);
</script>
@endsection

@endsection
