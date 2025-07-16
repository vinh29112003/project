<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class ReviewController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category, Post $post)
    {

        $post->load(['reviews.user']);
        return view('review.index', compact('category', 'post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category, Post $post)
    {
        // Trả về view form tạo nhận xét, có sẵn category và post để xử lý route
        return view('review.create', compact('category', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request, $id_category, $id_post)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Bạn phải đăng nhập để nhận xét.');
        }

        $post = Post::where('id', $id_post)->where('category_id', $id_category)->first();

        if (!$post) {
            return redirect()->back()->with('error', "Bài viết không tồn tại hoặc không đúng danh mục.");
        }


        Review::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'comment' => $request->comment,
        ]);

        return redirect()->route('categories.posts.reviews.index', [
            'category' => $id_category,
            'post' => $post->id,
        ])->with('success', 'Đánh giá đã được gửi thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category, Post $post, Review $review)
    {
        // Kiểm tra review có thuộc bài viết không
        if ($review->post_id !== $post->id) {
            abort(404);
        }

        return view('review.edit', compact('category', 'post', 'review'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category, Post $post, Review $review)
    {
        // Kiểm tra review có đúng post
        if ($review->post_id !== $post->id) {
            abort(404);
        }

        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $review->comment = $validated['comment'];
        $review->save();

        return redirect()->route('categories.posts.reviews.index', [$category->id, $post->id])
            ->with('success', 'Cập nhật nhận xét thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, Post $post, Review $review)
    {
        $review->delete();
        return redirect()->route('categories.posts.reviews.index', [$category->id, $post->id])
            ->with('success', 'Xoá nhận xét thành công.');
    }
}
