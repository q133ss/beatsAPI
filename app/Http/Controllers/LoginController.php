<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginController\LoginRequest;
use App\Services\LoginController\LoginService;

class LoginController extends Controller
{
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        return (new LoginService())->login($request->validated());
    }
}
