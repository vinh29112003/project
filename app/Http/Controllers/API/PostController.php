<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
        $this->authorizeResource(Post::class, 'post', [
            'index' => 'skip',
            'show' => 'skip',
        ]);
    }

    public function index(Category $category)
    {
        $posts = $category->posts()->with(['status', 'user'])->get();

        return response()->json([
            'success' => true,
            'data' => $posts,
        ]);
    }

    public function store(PostRequest $request, Category $category)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('images', $imageName, 'public');
            $imagePath = 'images/' . $imageName;
        }

        $post = Post::create([
            'title' => $request->title,
            'contents' => $request->contents,
            'category_id' => $request->category_id,
            'status_id' => $request->status_id,
            'image_path' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully.',
            'data' => $post,
        ], 201);
    }

    public function show(Category $category, Post $post)
    {
        return response()->json([
            'success' => true,
            'data' => $post->load(['category', 'status', 'user']),
        ]);
    }

    public function update(PostRequest $request, Category $category, Post $post)
    {
        $post->fill($request->only('title', 'contents', 'category_id', 'status_id'));
        $post->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $post->image_path = $imagePath;
        }

        $post->save();

        return response()->json([
            'success' => true,
            'message' => 'Post updated successfully.',
            'data' => $post,
        ]);
    }

    public function destroy(Category $category, Post $post)
    {
        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully.',
        ]);
    }
}
