<?php

namespace App\Repository;

use App\Interfaces\IAdminRepository;
use App\Models\Category;
use App\Models\Configuration;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\User;

class AdminRepository implements IAdminRepository
{
    public function getUsers()
    {
        return User::all();
    }

    public function getProducts()
    {
        return Product::all();
    }

    public function getCategorys()
    {
        return Category::all();
    }

    public function getPurchases()
    {
        return Purchase::all();
    }

    public function getConfiguration()
    {
        return Configuration::first();
    }

    public function defineStock(Configuration $configuration)
    {
        $configuration->save();
    }

    public function saveProduct(Product $product)
    {
        $product->save();
        return $product;
    }

    public function getCategoryById($arrayId)
    {
        return Category::find($arrayId);
    }

    public function modifyStockPrice($product_id, $stock, $price)
    {
        $product = Product::find($product_id);
        $product->stock = $stock;
        $product->price = $price;
        $product->save();
    }

}
