<?php

namespace App\Repository;

use App\Models\User;

class AuthRepository
{
    public function saveUser(User $user)
    {
        $user->save();
    }

}
