<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthorController\StoreAuthorRequest;
use App\Http\Requests\Admin\AuthorController\UpdateAuthorRequest;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Author::orderBy('created_at', 'DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request): \Illuminate\Http\JsonResponse
    {
        $author = Author::create($request->validated());
        return Response()->json(['author' => $author, 'message' => 'true']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author): Author
    {
        return $author;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $author->update($request->validated());
        return Response()->json(['author' => $author, 'message' => 'true']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return Response()->json(['message' => 'true']);
    }
}
