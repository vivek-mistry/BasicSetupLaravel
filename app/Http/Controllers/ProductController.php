<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('product_list');
    }

    public function create()
    {
        return view('product_create');
    }

    public function store(ProductRequest $request)
    {
        $request_data = $request->all();

        Product::create($request_data);

        return redirect()->route('product_list');
    }

    public function edit($id)
    {
        $data['product'] = Product::find($id);
        return view('product_edit')->with($data);
    }

    public function update($id, ProductRequest $request)
    {
        $request_data = $request->except(['_token','proengsoft_jsvalidation']);
        Product::where('id', $id)->update($request_data);
        return redirect()->route('product_list');
    }

    public function remove($id)
    {
        Product::destroy($id);

        return response()->json([true], 200);
    }
}
