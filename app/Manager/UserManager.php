<?php

namespace App\Manager;

use App\Http\Requests\BuyProductsRequest;
use App\Interfaces\IUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserManager
{
    protected $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getDataUserHome(Request $request)
    {
        $dataUser = [
            'purchases' => $this->getPurchaseByUserId($request->user()->id),
            'balance' => $request->user()->balance,
        ];

        return $dataUser;

    }

    public function getPurchaseByUserId($id)
    {
        return $this->userRepository->getPurchaseByUserId($id);
    }

    public function buyProducts(BuyProductsRequest $request)
    {
        $data = $this->validateJsonPurchase($request);
        //$data['products'][0]['response'] = 'ok';
        $response = $this->addPurchase($data, $request->user()->id);
        return $response;
    }

    public function validateJsonPurchase(BuyProductsRequest $request)
    {
        $data = json_decode($request->DataPurchase, true);
        $rules = [
            'product' => 'integer',
            'count' => 'integer',
        ];

        foreach ($data['products'] as $product) {
            $validator = Validator::make($product, $rules);
            if (!$validator->passes()) {
                throw new Exception("Bad Request", 400);
            }
        }

        return $data;

    }

    public function addPurchase($data, $user_id)
    {
        return $this->userRepository->addPurchase($data, $user_id);
    }

}
