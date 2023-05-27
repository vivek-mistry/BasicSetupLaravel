<?php

namespace App\Http\Controllers;

use App\DataTables\CustomerDataTable;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(CustomerDataTable $dataTable)
    {
        return $dataTable->render('customer_list');
    }

    public function create()
    {
        return view('customer_create');
    }

    public function store(CustomerStoreRequest $request)
    {
        $request_data = $request->all();

        Customer::create($request_data);

        return redirect()->route('customer_list');
    }

    public function edit($id)
    {
        $data['customer'] = Customer::find($id);
        return view('customer_edit')->with($data);
    }

    public function update($id, CustomerUpdateRequest $request)
    {
        $request_data = $request->except(['_token', 'proengsoft_jsvalidation']);
        Customer::where('id', $id)->update($request_data);
        return redirect()->route('customer_list');
    }
}
