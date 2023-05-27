<?php

namespace App\Listeners;

use App\Events\GenerateInvoiceEvent;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class GenerateInvoiceListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(GenerateInvoiceEvent $event): void
    {
        // dd($event);
        try{
            DB::beginTransaction();
            $customer = $this->createOrUpdateCustomer($event->request);

            $this->makeInvoiceEntry($customer, $event->request);

            $this->emptyCart();
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
        }
    }

    public function generateInvoiceNumber(){
        $today_date = Carbon::now();
        /**
         *  Month get toal number of Invoice
         */
        $total_student = Invoice::whereMonth('created_at', '=', $today_date->format('m'))->count() + 1;
        $format = str_pad($total_student, 4, '0', STR_PAD_LEFT);

        $unique_id = 'INV'.$today_date->format('m').$today_date->format('Y').$format;
        return $unique_id;
    }

    public function emptyCart()
    {
        DB::table('carts')->truncate();
    }

    public function createOrUpdateCustomer($request)
    {
        $customer = Customer::find($request->customer_id);
        if(!$request->customer_id)
        {
            $customer = new Customer();
            $customer->mobile_no = $request->mobile_no;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->save();
        }

        return $customer;
    }

    public function makeInvoiceEntry($customer, $request)
    {
        $invoice = Invoice::create([
            'customer_id' => $customer->id,
            'invoice_number' => $this->generateInvoiceNumber(),
            'total_price' => 0,
            'payment_type' => $request->payment_type,
            'note' => $request->note
        ]);

        $cart = Cart::all();
        $total_amount = 0;
        foreach($cart as $key => $value)
        {
            $total_amount += $value->total_price;
            InvoiceDetail::create([
                'customer_id' => $customer->id,
                'product_id' => $value->product_id,
                'invoice_id' => $invoice->id,
                'quantity' => $value->quantity,
                'per_quantity_price' => $value->per_quantity_price,
                'total_price' => $value->total_price
            ]);
        }

        $invoice->total_price = $total_amount;
        $invoice->save();

        return $invoice;
    }
}
