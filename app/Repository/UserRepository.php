<?php

namespace App\Repository;

use App\Interfaces\IUserRepository;
use App\Models\Configuration;
use App\Models\MethodPay;
use App\Models\Product;
use App\Models\ProductByPurchase;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;

class UserRepository implements IUserRepository
{
    public function getPurchaseByUserId($id)
    {
        $purchases = DB::table('purchase')
            ->join('product_by_purchase', 'purchase.id', '=', 'product_by_purchase.purchase_id')
            ->join('product', 'product_by_purchase.product_id', '=', 'product.id')
            ->select('purchase.*', 'product.name', 'product.description')
            ->where('user_id', $id)
            ->get();
        return $purchases;
    }

    public function addPurchase($data, $user_id)
    {
        if (MethodPay::where('id', '=', $data['method_pay'])->exists()) {
            $configuration = Configuration::first();
            $purchase = new Purchase();
            $purchase->method_pay_id = $data['method_pay'];
            $purchase->status = 0;
            $purchase->user_id = $user_id;

            foreach ($data['products'] as $key => $value) {
                if (Product::where('id', '=', $value['product'])->exists()) {
                    if ($configuration->where('min_stock', '>', $value['count'])->exists()) {
                        $purchase->save();
                        $pbp = new ProductByPurchase(['purchase_id' => $purchase->id,
                            'product_id' => $value['product']]);
                        $pbp->save();
                        $producto = Product::where('id', $value['product'])->first();
                        $producto->stock = $producto->stock - $value['count'];
                        $producto->save();
                        $data['products'][$key]['response'] = 'ok';
                    } else {
                        $data['products'][$key]['response'] = 'product not avilable';
                    }
                } else {
                    $data['products'][$key]['response'] = 'product not exist';
                }
            }
            return $data;

        } else {
            throw new Exception("Error bad Request", 400);
        }

    }

}
