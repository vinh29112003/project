<!DOCTYPE html>
<html>

<head>
    <title>Nhận xét bài viết</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
        }

        h2 {
            text-align: center;
            margin-top: 30px;
        }

        form {
            width: 60%;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            height: 100px;
            border-radius: 4px;
            border: 1px solid #ccc;
            resize: vertical;
        }

        button {
            padding: 10px 20px;
            background-color: #3490dc;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2779bd;
        }

        .comment-section {
            width: 60%;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #eee;
            border-radius: 8px;
        }

        .comment {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .comment:last-child {
            border-bottom: none;
        }

        .alert {
            width: 60%;
            margin: 10px auto;
            padding: 10px;
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
            border-radius: 4px;
        }

        .auth-warning {
            text-align: center;
            margin-top: 20px;
        }

        .auth-warning a {
            color: #3490dc;
            text-decoration: none;
            font-weight: bold;
        }

        .auth-warning a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <h2>Nhận xét bài viết</h2>

    {{-- Hiển thị lỗi nếu có --}}
    @if ($errors->any())
        <div class="alert">
            <strong>Đã xảy ra lỗi:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @auth
        @if(isset($category) && isset($post))
            <form method="POST" action="{{ route('review.store', ['category_id' => $category->id, 'post_id' => $post->id]) }}">
                @csrf
                <div class="mb-3">
                    <label for="comment" class="form-label">Nội dung nhận xét:</label>
                    <textarea name="comment" id="comment" class="form-control" rows="4" required
                        placeholder="Nhập nhận xét của bạn..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Gửi nhận xét</button>
            </form>
        @else
            <div class="alert alert-warning text-center">
                Không tìm thấy thông tin bài viết để gửi nhận xét.
            </div>
        @endif
    @else
        <div class="auth-warning text-center">
            Bạn phải <a href="{{ route('login') }}">đăng nhập</a> để nhận xét.
        </div>
    @endauth


    <div class="comment-section">
        <h3>Nhận xét gần đây</h3>
        @forelse ($post->reviews as $review)
            <div class="comment">
                <strong>{{ $review->user->name ?? 'Người dùng ẩn danh' }}</strong>:
                <p>{{ $review->comment }}</p>
            </div>
        @empty
            <p>Chưa có nhận xét nào cho bài viết này.</p>
        @endforelse
    </div>

</body>

</html>