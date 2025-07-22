<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa bài viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Chỉnh sửa bài viết</h2>

        <form action="{{ route('web.categories.posts.update', ['category' => $post->category_id, 'post' => $post->id]) }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Tiêu đề -->
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề:</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ $post->title }}" required>
            </div>

            <!-- Ảnh -->
            <div class="mb-3">
                <label class="form-label">Hình ảnh hiện tại:</label><br>
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" width="150" class="mb-2">
                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                @error('image')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nội dung -->
            <div class="mb-3">
                <label for="content" class="form-label">Nội dung:</label>
                <textarea id="content" name="contents" class="form-control" rows="6" required>{{ $post->contents }}</textarea>
            </div>

            <!-- Danh mục -->
            <div class="mb-3">
                <label for="category_id" class="form-label">Danh mục:</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $cat->id == $post->category_id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Trạng thái -->
            <div class="mb-3">
                <label for="status_id" class="form-label">Trạng thái:</label>
                <select name="status_id" id="status_id" class="form-select" required>
                    <option value="">-- Chọn trạng thái --</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}" {{ $post->status_id == $status->id ? 'selected' : '' }}>
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nút -->
            <button type="submit" class="btn btn-primary">Cập nhật bài viết</button>
            <a href="{{ route('web.categories.posts.index', $post->category_id) }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</body>

</html>
