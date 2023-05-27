<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * category relation load
     *
     * @return BelongsTo
     */
    public function category() :BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
