<?php
namespace App\Interfaces;

use App\Models\Configuration;
use App\Models\Product;

interface IAdminRepository
{
    public function getUsers();
    public function getProducts();
    public function getCategorys();
    public function getPurchases();
    public function getConfiguration();
    public function defineStock(Configuration $configuration);
    public function saveProduct(Product $product);
    public function getCategoryById($arrayId);
    public function modifyStockPrice($product_id, $stock, $price);
}
