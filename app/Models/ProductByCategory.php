<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductByCategory extends Model
{
    //
    protected $table = 'product_by_category';
    protected $fillable = [
        'product_id', 'category_id',
    ];
}
