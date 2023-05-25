@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Import Product</h1>
@stop

@section('content')


    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        {{-- <div class="card-header">
                            <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal"
                                data-target="#createCategoryModal">Add Category</button>
                        </div> --}}

                        <div class="card-body">
                            {{ Form::open(['url' => route('product_import_code'), 'files' => true, 'class' => 'multiple-form-submit']) }}


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="file" name="import" class="form-control" >
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">SAVE</button>

                            {{ Form::close() }}

                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (!empty($validation_errors))
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- .card-header -->
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            {{-- <div style="float: left;"><b style="color: red">Student Excel Error</b></div><br> --}}
                            <table id="student-list" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Row</th>
                                        <th>Category Name</th>
                                        <th>Product Name</th>
                                        <th>Price</th>

                                        <th>Error Messages</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($validation_errors as $validation)
                                        <tr>
                                            <td>{{$validation['row'] ?? '' }}</td>
                                            <td>{{$validation['category_name'] ?? ''}}</td>
                                            <td>{{$validation['product_name'] ?? ''}}</td>
                                            <td>{{$validation['price'] ?? ''}}</td>

                                            <td class="text-danger">{{$validation['error_messages'] ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- /.content -->
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .help-block {
            color: red;
        }
    </style>

@stop

@section('js')

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\ProductRequest') !!}

@stop
