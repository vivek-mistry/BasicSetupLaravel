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
                    <h2>Customer Detail
                        <a class="btn btn-warning float-right" id="reset_form"> Reset Form</a>
                    </h2>
                    {{ Form::open(['url' => route('generate_invoice'), 'files' => true, 'class' => 'multiple-form-submit']) }}
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Mobile No *</label>
                                <input type="hidden" id="customer_id" name="customer_id">
                                <input type="text" name="mobile_no" placeholder="Mobile No" id="mobile_no" class="typeahead form-control">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Name *</label>
                                <input type="text" name="name" placeholder="Name" id="name" class="form-control">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Email </label>
                                <input type="email" name="email" placeholder="Email" id="email" class="form-control">
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
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/jsvalidation.js') }}"></script>
{!! JsValidator::formRequest('App\Http\Requests\GenerateInvoiceRequest') !!}
    <script>
        $("#reset_form").on('click', function(){
            $('#mobile_no').val('');
            $('#name').val('');
            $('#email').val('');
            $('#customer_id').val('');
        });
        var route = BASE_URL + '/customer/search';
        $("#mobile_no").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: route,
                    type: 'GET',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        console.log(data);
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $('#mobile_no').val(ui.item.mobile_no);
                $('#name').val(ui.item.name);
                $('#email').val(ui.item.email);
                $('#customer_id').val(ui.item.id);

                return false;
            },
            change: function (event, ui) {
                if (ui.item === null) {
                    $('#parent_id').val('')
                    return false;
                }
            }

        }).autocomplete("instance")._renderItem = function(ul, item) {
            var item = item.name + '(' + item.mobile_no + ')'
            return $("<li>").append(item).appendTo(ul);
        };
    </script>
@stop
