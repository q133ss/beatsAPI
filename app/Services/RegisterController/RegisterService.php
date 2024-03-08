<?php
namespace App\Services\RegisterController;

use App\Models\User;

class RegisterService
{
    public function register(array $data): \Illuminate\Http\JsonResponse
    {
        $user = User::create($data);
        $token = $user->createToken('api')->plainTextToken;
        return Response()->json(['user' => $user, 'token' => $token]);
    }
}
