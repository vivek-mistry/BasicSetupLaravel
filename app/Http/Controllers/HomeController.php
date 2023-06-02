<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        $data['category_count'] = Category::all()->count();
        $data['product_count'] = Product::all()->count();
        $data['customer_count'] = Customer::all()->count();
        $data['invoice_count'] = Invoice::all()->count();

        $data['month_wise_invoice_count'] = $this->invoiceCurrentYear();

        // dd($data['month_wise_invoice_count']);
        return view('welcome')->with($data);
    }

    public function invoiceCurrentYear(){
        $year = Carbon::now()->format('Y');
        $invoice_count = [];
        for ($month = 01; $month <= 12; $month++) {
            $invoice = Invoice::whereYear('created_at', $year);

            $invoice->whereMonth('created_at', $month);

            $result = $invoice->get();

            $invoice_count[] = $result->count();
        }

        return implode(',', $invoice_count);
    }
}
