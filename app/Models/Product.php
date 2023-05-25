<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    private $table_name = 'products';

    public $fillable= [
        'category_id',
        'product_name',
        'product_image',
        'price'
    ];
}
