<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table_name = "invoices";

    public $fillable = [
        'customer_id',
        'invoice_number',
        'total_price',
        'payment_type',
        'note'
    ];
}
