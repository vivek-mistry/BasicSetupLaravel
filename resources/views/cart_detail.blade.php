@extends('master')

@section('title', 'Cart')

@section('content_header')
    <h1>Cart</h1>
    <x-base-url/>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Generate Invoice</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="cart_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Per Qunatity Price</th>
                                <th class="text-right">Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $bill_amount = 0;
                            @endphp
                            @forelse ($cart as $key => $value)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $value->product->product_name }} ({{ $value->product->category->name }})</td>
                                <td>{{ $value->quantity }}</td>
                                <td>{{ $value->per_quantity_price }}</td>
                                <td class="text-right">{{ $value->total_price }}</td>
                                <td>
                                    <a class='btn btn-sm btn-danger' onclick='removeFromCart({{ $value->id }})'><i class='fa fa-trash'></i></a>
                                </td>
                                @php
                                    $bill_amount += $value->total_price;
                                @endphp
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">Cart is emply</td>
                            </tr>
                            @endforelse


                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right">

                                        <strong>Total Amount:</strong>


                                </td>
                                <td class="text-right">{{ $bill_amount }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="card-footer">
                    <h2>Customer Detail</h2>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Mobile No *</label>
                                <input type="number" name="mobile_no" placeholder="Mobile No" class="form-control">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Name *</label>
                                <input type="text" name="name" placeholder="Name" class="form-control">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Email </label>
                                <input type="email" name="email" placeholder="Email" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Payment Type *</label>
                                <select name="payment_type" class="form-control">
                                    <option name="Cash">Cash</option>
                                    <option name="Gpay">Gpay</option>
                                    <option name="PhonePay">PhonePay</option>
                                    <option name="Online">Online</option>
                                    <option name="Pending">Pending</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Note </label>
                                <input type="text" name="note" placeholder="Note" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Generate Invoice</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
