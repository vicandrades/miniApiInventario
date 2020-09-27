<?php

namespace App\Models;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Model;

class MethodPay extends Model
{
    protected $table = 'method_pay';
    //
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
