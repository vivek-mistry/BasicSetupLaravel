<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    private $table_name = 'carts';

    public $fillable = [
        'product_id',
        'quantity',
        'per_quantity_price',
        'total_price'
    ];
}
