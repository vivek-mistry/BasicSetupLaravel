<?php

namespace App\Http\Controllers;

use App\DataTables\InvoiceDataTable;
use App\Events\GenerateInvoiceEvent;
use App\Http\Requests\GenerateInvoiceRequest;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function index(InvoiceDataTable $dataTable)
    {
        return $dataTable->render('invoice_list');
    }

    public function generateInvoice(GenerateInvoiceRequest $request)
    {
        event(new GenerateInvoiceEvent($request));

        return redirect()->route('cart_detail');
    }


}
