<?php

namespace App\Services\ProfileController;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    public function update(array $data): \Illuminate\Http\JsonResponse
    {
        $data['password'] = Hash::make($data['new_password']);

        unset($data['new_password']);
        unset($data['old_password']);

        User::where('email', $data['email'])->update($data);
        return Response()->json([
            'message' => 'true'
        ]);
    }
}
