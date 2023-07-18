<?php

namespace App\Traits\User;

use Tymon\JWTAuth\Facades\JWTAuth;

trait AuthTrait
{
    //Create token function
    public function create_token($user)
    {
        //Create token
        $token = JWTAuth::getFacadeRoot()->fromUser($user);
        //Response
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 3600,
        ]);
    }

    /**
     * Get the token array structure.
     *
     * @param  string  $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 3600,
        ]);
    }
}
