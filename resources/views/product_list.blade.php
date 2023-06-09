@extends('master')

@section('title', 'Product')

@section('content_header')
    <h1>Product</h1>
    <x-base-url/>
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
                            <a href="{{ route('product_create') }}" type="button" class="btn btn-primary btn-sm pull-right">Add Product</a>
                            <a href="{{ route('product_import') }}" type="button" class="btn btn-primary btn-sm pull-right">Bulk Product</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">

                            <!-- <div style="float: left;"><b>Today Registered Students</b></div> -->
                            <!-- <a class="btn btn-primary btn-sm" style="float:right">Add Coach</a> -->
                            {{ $dataTable->table() }}
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>

    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        function destroyData(product_id) {
            // alert(category_id);

            if (confirm("Are You sure?")) {
                $.ajax({
                    url: "{{ route('product_remove', '') }}/" + product_id,
                    type: "GET",
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        $("#product-table").DataTable().ajax.reload();

                    }
                });
            }
        }


    </script>
@stop
