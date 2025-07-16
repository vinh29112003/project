<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class PostController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category)
    {
        $posts = $category->posts;
        return view("post.index", compact('posts', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category)
    {
        $statuses = Status::all(); // Nếu bạn vẫn dùng status
        $categories = Category::all(); // Để hiển thị danh sách trong dropdown

        return view('post.create', [
            'category' => $category,
            'categories' => $categories,
            'statuses' => $statuses, // Nếu bỏ status thì có thể xoá dòng này
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
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
            'content' => $request->content,
            'category_id' => $request->category_id,
            'status_id' => $request->status_id,
            'image_path' => $imagePath,
        ]);


        return redirect()->route('categories.posts.index', ['category' => $category->id])
            ->with('success', 'Bài viết đã được thêm thành công.');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($categoryId, $postId)
    {
        $post = Post::findOrFail($postId);
        $categories = Category::all();
        $statuses = Status::all();
        return view('post.edit', compact('post', 'categories', 'statuses'));
    }

    public function show() {}
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $categoryId, $postId)
    {
        $post = Post::findOrFail($postId);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->status_id = $request->status_id;

        // Cập nhật ảnh nếu có
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images', 'public');
            $post->image_path = $image;
        }

        $post->save();

        return redirect()->route('categories.posts.index', $categoryId)->with('success', 'Cập nhật thành công!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, Post $post)
    {
        $post->delete();

        return redirect()->route('categories.posts.index', ['category' => $category->id])
            ->with('success', 'Bài viết đã xoá thành công.');
    }
}
