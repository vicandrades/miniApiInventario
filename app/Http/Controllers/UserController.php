<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyProductsRequest;
use App\Manager\UserManager;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function userHome(Request $request)
    {
        try {
            $datauserHome = $this->userManager->getDataUserHome($request);
            return response()->json($datauserHome);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'Error procesando solicitud'], 400);
        }
    }

    public function buyProducts(BuyProductsRequest $request)
    {
        // try {
        $response = $this->userManager->buyProducts($request);
        return response()->json($response, 200);
        // } catch (\Exception $ex) {
        //    return response()->json([
        //        'message' => 'Error procesando solicitud'], 400);
        // }
    }
}
