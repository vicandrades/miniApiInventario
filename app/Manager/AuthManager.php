<?php

namespace App\Manager;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthSignUpRequest;
use App\Models\User;
use App\Repository\AuthRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthManager
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function signup(AuthSignUpRequest $request)
    {
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $this->authRepository->saveUser($user);
    }

    public function validateLogin(AuthLoginRequest $request)
    {
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'], 401);
        }

        $token = $this->generateToken($request->user());
        return $token;
    }

    public function generateToken(User $user)
    {
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return $tokenResult;
    }
}
