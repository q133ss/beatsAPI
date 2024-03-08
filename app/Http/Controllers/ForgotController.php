<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotController\CheckRequest;
use App\Http\Requests\ForgotController\ForgotRequest;
use App\Services\ForgotController\ForgotService;
use Illuminate\Http\Request;

class ForgotController extends Controller
{
    public function forgot(ForgotRequest $request): \Illuminate\Http\JsonResponse
    {
        return (new ForgotService())->forgot($request->get('email'));
    }

    public function check(CheckRequest $request): \Illuminate\Http\JsonResponse
    {
        return (new ForgotService())->check($request->validated());
    }
}
