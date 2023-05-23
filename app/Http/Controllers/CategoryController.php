<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('category_list');
    }

    public function store(CategoryRequest $request)
    {
        $request_data['name'] = $request->name;

        $category = Category::create($request_data);

        return redirect()->route('category_list');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json(['category' => $category], 200);
    }

    public function update($id, CategoryRequest $request)
    {
        $request_data['name'] = $request->name;

        $category = Category::where('id', $id)->update($request_data);

        return redirect()->route('category_list');
    }

    public function remove($id)
    {
        Category::destroy($id);

        return response()->json([true], 200);
    }
}
