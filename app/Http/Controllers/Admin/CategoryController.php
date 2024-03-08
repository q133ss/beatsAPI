<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryController\StoreCategoryRequest;
use App\Http\Requests\Admin\CategoryController\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::orderBy('created_at', 'DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): \Illuminate\Http\JsonResponse
    {
        $category = Category::create($request->validated());
        return Response()->json(['category' => $category, 'message' => 'true']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): Category
    {
        return $category;
    }

    /**
     * Return parent cats
     */
    public function getParent()
    {
        return Category::where('parent_id', null)->orderBy('created_at', 'DESC')->get();
    }

    public function getChild(int $id)
    {
        return Category::findOrFail($id)->children()->orderBy('created_at', 'DESC')->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category): \Illuminate\Http\JsonResponse
    {
        $category->update($request->validated());
        return Response()->json(['category' => $category ,'message' => 'true']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): \Illuminate\Http\JsonResponse
    {
        $category->delete();
        return Response()->json(['message' => 'true']);
    }
}
