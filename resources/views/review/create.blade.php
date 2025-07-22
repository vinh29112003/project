<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gửi Nhận Xét</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h3 class="text-center mb-4">Gửi Nhận Xét Cho Bài Viết</h3>

        @auth
            @if(isset($category) && isset($post))
                <form method="POST" action="{{ route('web.categories.posts.reviews.store', [$category->id, $post->id]) }}" class="bg-white p-4 shadow rounded">
                    @csrf

                    <div class="mb-3">
                        <label for="comment" class="form-label">Nội dung nhận xét:</label>
                        <textarea name="comment" id="comment" class="form-control" rows="4" required placeholder="Nhập nhận xét của bạn..."></textarea>
                        @error('comment')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Gửi nhận xét</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Quay lại</a>
                </form>
            @else
                <div class="alert alert-warning text-center">
                    Không tìm thấy thông tin bài viết để gửi nhận xét.
                </div>
            @endif
        @else
            <div class="alert alert-info text-center">
                Bạn phải <a href="{{ route('login') }}">đăng nhập</a> để nhận xét.
            </div>
        @endauth
    </div>

</body>
</html>
