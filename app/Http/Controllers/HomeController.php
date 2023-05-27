<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
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
        return view('welcome')->with($data);
    }
}
