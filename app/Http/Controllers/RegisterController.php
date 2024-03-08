<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterController\RegisterRequest;
use App\Services\RegisterController\RegisterService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        return (new RegisterService())->register($request->validated());
    }
}
