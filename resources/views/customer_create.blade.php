@extends('master')

@section('title', 'Create Customer')

@section('content_header')
    <h1>Create Customer</h1>
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
                            {{ Form::open(['url' => route('customer_store'), 'files' => true, 'class' => 'multiple-form-submit']) }}

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="number" name="mobile_no" class="form-control" placeholder="Mobile No">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" placeholder="Email">
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
    {!! JsValidator::formRequest('App\Http\Requests\CustomerStoreRequest') !!}

@stop
