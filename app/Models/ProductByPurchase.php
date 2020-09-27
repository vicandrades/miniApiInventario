<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductByPurchase extends Model
{
    protected $table = 'product_by_purchase';
    protected $fillable = [
        'product_id', 'purchase_id',
    ];
}
