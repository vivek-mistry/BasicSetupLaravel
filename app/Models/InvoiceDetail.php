<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $table_name = 'invoice_details';

    public $fillable = ['invoice_id', 'product_id', 'customer_id', 'quantity', 'per_quantity_price', 'total_price'];
}
