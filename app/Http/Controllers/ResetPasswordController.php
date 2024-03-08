<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordController\ResetRequest;
use App\Services\ResetPasswordController\ResetService;

class ResetPasswordController extends Controller
{
    public function reset(ResetRequest $request): \Illuminate\Http\JsonResponse
    {
        return (new ResetService())->reset($request->validated());
    }
}
