<?php

namespace App\Services\ResetPasswordController;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetService
{
    public function reset(array $data): \Illuminate\Http\JsonResponse
    {
        $user = User::where('email', $data['email']);
        $user->update(['password' => Hash::make($data['password'])]);
        $token = $user->first()->createToken('api')->plainTextToken;

        DB::table('password_resets')->where('email', $data['email'])
            ->where('token', $data['token'])
            ->delete();

        return Response()->json(['user' => $user->first(), 'token' => $token]);
    }
}
