<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayController\PayRequest;
use Illuminate\Http\Request;

class PayController extends Controller
{
    public function pay(PayRequest $request)
    {
        return Response()->json(['link' => 'https://pay-link.ru/12345']);
    }
}
