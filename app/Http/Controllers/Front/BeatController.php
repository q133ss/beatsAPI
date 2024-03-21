<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BeatController\StoreBeatRequest;
use App\Http\Requests\Admin\BeatController\UpdateBeatRequest;
use App\Models\Author;
use App\Models\Beat;
use App\Models\Category;
use Illuminate\Http\Request;

class BeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beats = Beat::with('author', 'category', 'demoFile', 'fullFile')->orderBy('created_at', 'DESC')->get();
        return view('beat.index', compact('beats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::orderBy('created_at', 'DESC')->get();
        $categories = Category::orderBy('created_at', 'DESC')->get();
        return view('beat.create', compact('authors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBeatRequest $request)
    {
        (new \App\Http\Controllers\Admin\BeatController())->store($request);
        return to_route('beat.index')->withSuccess('Бит успешно добавлен');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $beat = Beat::findOrFail($id);
        $authors = Author::orderBy('created_at', 'DESC')->get();
        $categories = Category::orderBy('created_at', 'DESC')->get();
        return view('beat.edit', compact('beat', 'authors', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBeatRequest $request, Beat $beat)
    {
        (new \App\Http\Controllers\Admin\BeatController())->update($request, $beat);
        return to_route('beat.index')->withSuccess('Бит успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Beat $beat)
    {
        (new \App\Http\Controllers\Admin\BeatController())->destroy($beat);
        return to_route('beat.index')->withSuccess('Бит успешно удален');
    }
}
