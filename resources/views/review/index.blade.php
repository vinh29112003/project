<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bảng nhận xét</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Bảng Nhận Xét</h2>

    {{-- Hiển thị lỗi --}}
    @if ($errors->any())
        <div class="alert alert-warning">
            <strong>Đã xảy ra lỗi:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Nút thêm nhận xét --}}
    <div class="mb-3 text-end">
        <a href="{{ route('categories.posts.reviews.create', [$category->id, $post->id]) }}"
           class="btn btn-primary">
            + Thêm nhận xét
        </a>
    </div>

    {{-- Danh sách nhận xét --}}
    @if ($post->reviews->isEmpty())
        <div class="alert alert-info text-center">Chưa có nhận xét nào.</div>
    @else
        <table class="table table-bordered table-hover bg-white shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>Người nhận xét</th>
                    <th>Bài viết</th>
                    <th>Nội dung</th>
                    <th>Thời gian</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($post->reviews as $review)
                    <tr>
                        <td>{{ $review->user->name }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $review->comment }}</td>
                        <td>{{ $review->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            {{-- Sửa --}}
                            @can('update', $review)
                            <a href="{{ route('categories.posts.reviews.edit', [$category->id, $post->id, $review->id]) }}"
                               class="btn btn-sm btn-warning me-1">
                                Sửa
                            </a>
                            @endcan

                            {{-- Xem --}}

                            {{-- Xoá --}}
                            @can('delete', $review)
                            <form action="{{ route('categories.posts.reviews.destroy', [$category->id, $post->id, $review->id]) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Bạn có chắc chắn muốn xoá nhận xét này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Xoá
                                </button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

</body>
</html>
