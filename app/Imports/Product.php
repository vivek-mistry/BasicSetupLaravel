<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product as ModelsProduct;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class Product implements ToCollection, WithStartRow, WithHeadingRow, WithValidation
{

    public $insert_count = 0;
    public $error_count = 0;
    public $data_error = [];
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // dd($collection);
        foreach($collection as $row)
        {
            // dd($row);
            $category = Category::where('name', $row['category_name'])->first();
            if(!$category){
                $category = new Category();
                $category->name = $row['category_name'];
                $category->save();
            }
            $product = new ModelsProduct();
            $product->category_id = $category->id;
            $product->product_name = $row['product_name'];
            $product->price = $row['price'];
            $product->save();
        }
    }

    public function startRow(): int
    {
        return 2;
    }

    public function onFailure(Validator $validator) //Failure ...$failures
    {
        return $validator;
        // $exception = ValidationException::withMessages(collect($failures)->map->toArray()->all());
        // dd($exception);
        // throw $exception;
    }

    public function rules(): array
    {

        return [
            'category_name' => ['required'],
            'product_name' => ['required'],
            'price' => ['required']
        ];


    }
}
