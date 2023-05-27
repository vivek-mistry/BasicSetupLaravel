<?php

namespace App\Http\Controllers;

use App\Events\GenerateInvoiceEvent;
use App\Http\Requests\GenerateInvoiceRequest;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function index()
    {

    }

    public function generateInvoice(GenerateInvoiceRequest $request)
    {
        event(new GenerateInvoiceEvent($request));

        return redirect()->route('cart_detail');
    }


}
