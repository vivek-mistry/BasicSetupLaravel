<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    private $table_name = 'categories';

    public $fillable= [
        'name',
        'category_image'
    ];
}
