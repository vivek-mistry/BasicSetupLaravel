<html>

<head>
    <title>Invoice</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="invoice_detail" id="invoice_detail">


            <div class="row">
                <div class="col-xs-12">
                    <div class="invoice-title">
                        <h2>Invoice</h2>
                        <h3 class="pull-right">INVOICE # {{ $invoice->invoice_number }}</h3>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                                <strong>Billed To:</strong><br>
                                {{ $invoice->customer->name }}<br>
                                {{ $invoice->customer->mobile_no }}<br>
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                            {{-- <address>
        			<strong>Shipped To:</strong><br>
    					Jane Smith<br>
    					1234 Main<br>
    					Apt. 4B<br>
    					Springfield, ST 54321
    				</address> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                                <strong>Payment Method:</strong><br>
                                {{ $invoice->payment_type }}<br>
                                {{ $invoice->note }}
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                            <address>
                                <strong>Order Date:</strong><br>
                                {{ setDateFormat($invoice->created_at) }}<br><br>
                            </address>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Order summary</strong></h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <td><strong>Item</strong></td>
                                            <td class="text-center"><strong>Price</strong></td>
                                            <td class="text-center"><strong>Quantity</strong></td>
                                            <td class="text-right"><strong>Totals</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                        @foreach ($invoice->invoice_detail as $value)
                                            <tr>
                                                <td>{{ $value->product->product_name }}</td>
                                                <td class="text-center">{{ $value->per_quantity_price }}</td>
                                                <td class="text-center">{{ $value->quantity }}</td>
                                                <td class="text-right">{{ $value->total_price }}</td>
                                            </tr>
                                        @endforeach


                                        {{-- <tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">$670.99</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Shipping</strong></td>
    								<td class="no-line text-right">$15</td>
    							</tr> --}}
                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center"><strong>Total</strong></td>
                                            <td class="no-line text-right">{{ $invoice->total_price }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="pull-right">
                <button type="button" class="btn btn-success" onclick="window.print()">Print</button>
            </div>
        </div>
    </div>
</body>
    <script>
        function print()
        {
            // alert();
            // var elem = document.getElementById("invoice_detail")

            // var domClone = elem.cloneNode(true);

            // var $printSection = document.getElementById("printSection");

            // if (!$printSection) {
            //     var $printSection = document.createElement("div");
            //     $printSection.id = "printSection";
            //     document.body.appendChild($printSection);
            // }

            // $printSection.innerHTML = "";
            // $printSection.appendChild(domClone);
            window.print();
        }
    </script>
</html>
