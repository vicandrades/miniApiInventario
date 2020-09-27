<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\DefineMinStockRequest;
use App\Http\Requests\ModifyStockPriceRequest;
use App\Manager\AdminManager;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminManager;

    public function __construct(AdminManager $adminManager)
    {
        $this->adminManager = $adminManager;
    }

    public function adminHome(Request $request)
    {
        try {
            $dataAdminHome = $this->adminManager->getDataAdminHome();
            return response()->json($dataAdminHome);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'Error procesando solicitud'], 400);
        }
    }

    public function addProduct(AddProductRequest $request)
    {
        try {
            $this->adminManager->addProduct($request);
            return response()->json([
                'message' => 'Successfully created Product!'], 201);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'Error procesando solicitud'], 400);
        }

    }

    public function defineMinStock(DefineMinStockRequest $request)
    {
        try {
            $this->adminManager->defineStock($request);
            return response()->json([
                'message' => 'Successfully updated Configuration min Stock!'], 201);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'Error procesando solicitud'], 400);
        }

    }

    public function modifyStockPrice(ModifyStockPriceRequest $request)
    {
        try {
            $this->adminManager->modifyStockPrice($request);
            return response()->json([
                'message' => 'Successfully updated Stock and Price!'], 201);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'Error procesando solicitud'], 400);
        }

    }
}
