@extends('master')

@section('title', 'Category')

@section('content_header')
    <h1>Category</h1>
@stop

@section('content')


    <!-- Main content -->
    <section class="content">
        {{-- @include('admin.alert.failed-validate') --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal"
                                data-target="#createCategoryModal">Add Category</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <!-- <div style="float: left;"><b>Today Registered Students</b></div> -->
                            <!-- <a class="btn btn-primary btn-sm" style="float:right">Add Coach</a> -->
                            {{ $dataTable->table() }}
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <div id="createCategoryModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Add Category</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    {{ Form::open(['url' => route('category_store'), 'files' => true, 'class' => 'multiple-form-submit']) }}
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">SAVE</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    {{ Form::close() }}
                </div>

            </div>
        </div>
        <div id="updateCategoryModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Update Category</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    {{ Form::open(['files' => true, 'id' => 'form-update', 'class' => 'multiple-form-submit']) }}
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">SAVE</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    {{ Form::close() }}
                </div>

            </div>
    </section>
    <!-- /.content -->
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .help-block{
            color: red;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\CategoryRequest') !!}
    <script>
        function destroyData(category_id) {
            // alert(category_id);

            if (confirm("Are You sure?")) {
                $.ajax({
                    url: "{{ route('category_remove', '') }}/" + category_id,
                    type: "GET",
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        $("#category-table").DataTable().ajax.reload();

                    }
                });
            }
        }

        function edit(category_id)
        {
            $.ajax({
                url: "{{ route('category_edit', '') }}/" + category_id,
                type: "GET",
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $("#updateCategoryModal").modal('show');
                    $("#name").val(response.category.name);



                    $("#form-update").attr('action', "{{ route('category_update', '') }}/"+response.category.id)
                }
            });
        }
    </script>
@stop
