<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'product';

    protected $fillable = [
        'name', 'price', 'stock', 'description',
    ];

    public function category()
    {
        return $this->belongsToMany(Category::class, 'product_by_category');
    }

    public function purchases()
    {
        return $this->belongsToMany(Purchase::class, 'product_by_purchase');
    }
}
