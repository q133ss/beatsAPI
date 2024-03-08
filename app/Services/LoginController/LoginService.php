<?php
namespace App\Services\LoginController;

use App\Models\User;

class LoginService
{
    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(array $data): \Illuminate\Http\JsonResponse
    {
        $user = User::where('email', $data['email'])->first();
        $token = $user->createToken('api')->plainTextToken;
        return Response()->json(['user' => $user, 'token' => $token]);
    }
}
