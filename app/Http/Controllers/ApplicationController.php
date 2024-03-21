<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationController\StoreRequest;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function store(StoreRequest $request)
    {
        return Response()->json(Application::create($request->validated()));
    }
}
