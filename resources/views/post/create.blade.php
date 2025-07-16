<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Tạo bài viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Thêm bài viết</h2>

        <form action="{{ route('categories.posts.store', ['category' => $category->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề:</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="Nhập tiêu đề bài viết"
                    required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Nội dung:</label>
                <textarea id="content" name="content" class="form-control" rows="6"
                    placeholder="Nhập nội dung bài viết"></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh:</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                @error('image')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Danh mục:</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    <option value="">-- Chọn danh mục --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="status_id" class="form-label">Trạng thái:</label>
                <select name="status_id" id="status_id" class="form-select" required>
                    <option value="">-- Chọn trạng thái --</option>
                    <option value="1">Nháp</option>
                    <option value="2">Công khai</option>
                    <option value="3">Lưu trữ</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Thêm bài viết</button>
            <a href="{{ route('categories.posts.index', ['category' => $category->id]) }}"
                class="btn btn-secondary">Hủy</a>

            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <strong>Đã xảy ra lỗi!</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
</body>

</html>