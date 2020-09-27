<?php

namespace App\Http\Controllers;

use App\Http\Requests\authLoginRequest;
use App\Http\Requests\AuthSignUpRequest;
use App\Manager\AuthManager;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authManager;

    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }

    public function signup(AuthSignUpRequest $request)
    {

        try {
            $this->authManager->signup($request);
            return response()->json([
                'message' => 'Successfully created user!'], 201);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'Error procesando solicitud'], 400);
        }

    }

    public function login(authLoginRequest $request)
    {
        try {
            $tokenResult = $this->authManager->validateLogin($request);
            $user = $request->user();

            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at)
                    ->toDateTimeString(),
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'Error procesando solicitud'], 400);
        }

    }

    public function logout(Request $request)
    {
        try {
            $request->user()->token()->revoke();
            return response()->json(['message' =>
                'Successfully logged out']);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'Error procesando solicitud'], 400);
        }
    }

    public function user(Request $request)
    {
        return response()->json($request->user());

    }
}
