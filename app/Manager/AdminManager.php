<?php

namespace App\Manager;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\DefineMinStockRequest;
use App\Http\Requests\ModifyStockPriceRequest;
use App\Interfaces\IAdminRepository;
use App\Models\Product;
use App\Models\ProductByCategory;

class AdminManager
{
    protected $adminRepository;

    public function __construct(IAdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function getDataAdminHome()
    {
        $dataAdmin = [
            'user' => $this->getUsers(),
            'product' => $this->getProducts(),
            'category' => $this->getCategorys(),
            'purchase' => $this->getPurchases(),
        ];

        return $dataAdmin;

    }

    public function addProduct(AddProductRequest $request)
    {
        $product = new Product([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
        ]);

        $categorys = $this->getCategoryById($request->categorys);
        $product = $this->saveProduct($product);

        $pbc = new ProductByCategory(['product_id' => $product->id]);

        $this->getCategoryById($pbc, $categorys);
    }

    public function defineStock(DefineMinStockRequest $request)
    {
        $configuration = $this->getConfiguration();
        $configuration->min_stock = $request->stock;
        $this->adminRepository->defineStock($configuration);
    }

    public function modifyStockPrice(ModifyStockPriceRequest $request)
    {
        $this->adminRepository->modifyStockPrice($request->product_id, $request->stock, $request->price);
    }

    public function getConfiguration()
    {
        return $this->adminRepository->getConfiguration();
    }
    public function addProductByCategory(ProductByCategory $pbc, $categorys)
    {

        foreach ($categorys as $category) {
            $pbc->category_id = $category->id;
            saveProductByCategory($pbc);
        }
    }

    public function getUsers()
    {
        return $this->adminRepository->getUsers();
    }

    public function getProducts()
    {
        return $this->adminRepository->getProducts();
    }

    public function getCategorys()
    {
        return $this->adminRepository->getCategorys();
    }

    public function getCategoryById($arrayId)
    {
        return $this->adminRepository->getCategoryById($arrayId);
    }

    public function getPurchases()
    {
        return $this->adminRepository->getPurchases();
    }

    public function saveProduct($product)
    {
        return $this->adminRepository->saveProduct($product);
    }

    public function saveProductByCategory($pbc)
    {
        return $this->adminRepository->saveProductByCategory($pbc);
    }

}
