<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa nhận xét</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Chỉnh sửa nhận xét</h2>

    {{-- Thông báo lỗi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Đã xảy ra lỗi!</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form chỉnh sửa nhận xét --}}
    <form action="{{ route('web.categories.posts.reviews.update', [$category->id, $post->id, $review->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="comment" class="form-label">Nội dung nhận xét:</label>
            <textarea name="comment" id="comment" class="form-control" rows="5" required>{{ old('comment', $review->comment) }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('web.categories.posts.reviews.index', [$category->id, $post->id]) }}" class="btn btn-secondary">
                ← Quay lại
            </a>
            <button type="submit" class="btn btn-success">Cập nhật</button>
        </div>
    </form>
</div>

</body>
</html>
