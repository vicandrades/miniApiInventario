<?php
namespace App\Interfaces;

interface IUserRepository
{
    public function getPurchaseByUserId($id);
    public function addPurchase($data, $user_id);
}
