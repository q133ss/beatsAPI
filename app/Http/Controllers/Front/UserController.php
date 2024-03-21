<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserController\StoreUserRequest;
use App\Http\Requests\Admin\UserController\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->get();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        (new \App\Http\Controllers\Admin\UserController())->store($request);
        return to_route('user.index')->withSuccess('Пользователь успешно добавлен');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        (new \App\Http\Controllers\Admin\UserController())->update($request, $user);
        return to_route('user.index')->withSuccess('Пользователь успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        (new \App\Http\Controllers\Admin\UserController())->destroy($user);
        return to_route('user.index')->withSuccess('Пользователь успешно удален');
    }
}
