@extends('master')

@section('title', 'Edit Product')

@section('content_header')
    <h1>Edit Product</h1>
    <x-base-url/>
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
                            {{ Form::open(['url' => route('product_update', ['id' => $product->id]), 'files' => true, 'class' => 'multiple-form-submit']) }}
                                <div class="row">
                                    <x-category-dropdown column-class="col-sm-6" selected="{{ $product->category_id }}" name="category_id" />
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="product_name" class="form-control" placeholder="Product Name" value="{{ $product->product_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="price" class="form-control" placeholder="Product Price" value="{{ $product->price }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="file" name="image" class="form-control" >
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
