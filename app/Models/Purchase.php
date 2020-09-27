<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchase';

    public function methodPay()
    {
        return $this->belongsTo(MethodPay::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_by_purchase');
    }
}
