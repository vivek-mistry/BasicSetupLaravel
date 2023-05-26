<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Http\Requests\ProductRequest;
use App\Imports\Product as ImportsProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

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
        $request_data = $request->except(['_token', 'proengsoft_jsvalidation']);
        Product::where('id', $id)->update($request_data);
        return redirect()->route('product_list');
    }

    public function remove($id)
    {
        Product::destroy($id);

        return response()->json([true], 200);
    }

    public function import()
    {
        return view('product_import');
    }

    public function importCode(Request $request)
    {
        $import = new ImportsProduct();
        try {
            // $extension = $request->import->extension();

            // if ($extension == 'xlsx') {
            $imports = Excel::import($import, $request->file('import')->store('import'));
            $data['insert_count'] = $import->insert_count;
            $data['error_count'] = $import->error_count;

            $data['validation_errors'] = $import->data_error;
            $data['true'] = 'true';
            return view('product_import')->with($data);
            // } else {
            //     return redirect()->route('product_import');
            // }
        } catch (ValidationException $e) {
            $change_message[] = '';
            $error_and_data = collect($e->failures());
            $map_error_unique_data = collect();
            $unique_data = $error_and_data->map(function ($array) use ($map_error_unique_data) {
                $exist = collect($map_error_unique_data)
                    ->where('row', $array->row())
                    ->first();
                if (!isset($exist['row'])) {
                    $value = $array->values();
                    $value['row'] = $array->row();
                    $value['error_messages'] = implode(',', $array->errors());
                    $map_error_unique_data[] = $value;
                } else {
                    $message = $exist['error_messages'] .= '|' . implode(',', $array->errors());
                    $index = $map_error_unique_data->search(function ($excel_Row) use ($exist, $message) {
                        return $excel_Row['row'] === $exist['row'];
                    });
                    unset($map_error_unique_data[$index]);
                    $map_error_unique_data[] = $exist;
                }
            });

            $data['validation_errors'] = $map_error_unique_data;

            return view('product_import')->with($data);
        }
    }
}
