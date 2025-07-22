<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index');
        $this->authorizeResource(Category::class, 'category', [
            'index' => 'skip'
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Category::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->only('name', 'description'));

        return response()->json([
            'message' => 'Thêm danh mục thành công!',
            'data' => $category
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json($category, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->only('name', 'description'));

        return response()->json([
            'message' => 'Cập nhật danh mục thành công!',
            'data' => $category
        ], 200);
    }
    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'Xoá danh mục thành công.'
        ], 200);
    }
}
