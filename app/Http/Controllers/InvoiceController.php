<?php

namespace App\Http\Controllers;

use App\DataTables\InvoiceDataTable;
use App\Events\GenerateInvoiceEvent;
use App\Http\Requests\GenerateInvoiceRequest;
use App\Models\Invoice;
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

    public function detail($invoice_id)
    {
        $data['invoice'] = Invoice::with(['customer', 'invoice_detail', 'invoice_detail.product'])->where('id' ,'=', $invoice_id)->first();
        // dd($data['invoice']);
        return view('invoice_detail')->with($data);
    }


}
