<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryController\StoreCategoryRequest;
use App\Http\Requests\Admin\CategoryController\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('getChildren', 'getParent')->where('parent_id', null)->orderBy('created_at', 'DESC')->get();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $store = (new \App\Http\Controllers\Admin\CategoryController())->store($request);
        return to_route('category.edit', $store->getData()->category->id)->withSuccess('Категория успешно добавлена');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::where('id', '!=', $id)->orderBy('id', 'DESC')->get();
        return view('category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $update = (new \App\Http\Controllers\Admin\CategoryController())->update($request, $category);
        return to_route('category.edit', $update->getData()->category->id)->withSuccess('Категория успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $delete = (new \App\Http\Controllers\Admin\CategoryController())->destroy($category);
        return to_route('category.index')->withSuccess('Категория успешно удалена');
    }
}
