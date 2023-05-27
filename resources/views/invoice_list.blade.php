@extends('master')

@section('title', 'Invoice')

@section('content_header')
    <h1>Invoice</h1>
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

    </section>
    <!-- /.content -->
@stop

@section('css')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}


@stop
