<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category, Post $post)
    {
        $reviews = $post->reviews()->with('user')->get();

        return response()->json([
            'success' => true,
            'data' => $reviews
        ]);
    }

    /**
     * Tạo đánh giá mới.
     */
    public function store(ReviewRequest $request, Category $category, Post $post)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn phải đăng nhập để nhận xét.'
            ], 401);
        }

        $review = Review::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Đánh giá đã được tạo thành công.',
            'data' => $review
        ], 201);
    }

    /**
     * Hiển thị 1 đánh giá cụ thể.
     */
    public function show(Category $category, Post $post, Review $review)
    {
        if ($review->post_id !== $post->id) {
            return response()->json([
                'success' => false,
                'message' => 'Đánh giá không thuộc về bài viết này.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $review->load('user')
        ]);
    }

    /**
     * Cập nhật 1 đánh giá.
     */
    public function update(Request $request, Category $category, Post $post, Review $review)
    {
        if ($review->post_id !== $post->id) {
            return response()->json([
                'success' => false,
                'message' => 'Đánh giá không thuộc về bài viết này.'
            ], 404);
        }

        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $review->update(['comment' => $validated['comment']]);

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật đánh giá thành công.',
            'data' => $review
        ]);
    }

    /**
     * Xoá 1 đánh giá.
     */
    public function destroy(Category $category, Post $post, Review $review)
    {
        if ($review->post_id !== $post->id) {
            return response()->json([
                'success' => false,
                'message' => 'Đánh giá không thuộc về bài viết này.'
            ], 404);
        }

        $review->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xoá đánh giá thành công.'
        ]);
    }
    
}
