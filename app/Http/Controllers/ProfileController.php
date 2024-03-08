<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileController\UpdateRequest;
use App\Models\User;
use App\Services\ProfileController\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(UpdateRequest $request): \Illuminate\Http\JsonResponse
    {
        return (new ProfileService())->update($request->validated());
    }
}
