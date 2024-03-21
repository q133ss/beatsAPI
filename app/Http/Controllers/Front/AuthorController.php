<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthorController\StoreAuthorRequest;
use App\Http\Requests\Admin\AuthorController\UpdateAuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::orderBy('created_at', 'DESC')->get();
        return view('author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request)
    {
        (new \App\Http\Controllers\Admin\AuthorController())->store($request);
        return to_route('author.index')->withSuccess('Автор успешно добавлен');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $author = Author::findOrFail($id);
        return view('author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        (new \App\Http\Controllers\Admin\AuthorController())->update($request, $author);
        return to_route('author.index')->withSuccess('Автор успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        (new \App\Http\Controllers\Admin\AuthorController())->destroy($author);
        return to_route('author.index')->withSuccess('Автор успешно удален!');
    }
}
