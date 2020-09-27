<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    //
    public function products()
    {
        return $this->belongsToMany(Product::class . 'product_by_category');
    }
}
