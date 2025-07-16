<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách Chi tiết Bài viết</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .table-container {
            margin-top: 40px;
        }

        .action-link {
            text-decoration: none;
            font-weight: 500;
        }

        .action-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <!-- Tiêu đề & nút login/logout -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Danh sách Chi tiết Bài viết</h2>
            <div>
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary">Đăng nhập</a>
                @endguest

                @auth
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Đăng xuất</button>
                    </form>
                @endauth
            </div>
        </div>

        <!-- Bảng danh sách -->
        <div class="table-responsive table-container">
            <table class="table table-bordered table-hover align-middle text-center shadow-sm bg-white">
                <thead class="table-light">
                    <tr>
                        <th>STT</th>
                        <th>Hình ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung</th>
                        <th>Danh mục</th>
                        <th>Trạng thái</th>
                        <th>Lượt nhận xét</th>
                        <th>Nhận xét</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}"></td>
                            <td class="text-start">{{ $post->title }}</td>
                            <td class="text-start">{{ \Illuminate\Support\Str::limit($post->content, 50) }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td>{{ $post->status->name }}</td>
                            <td>{{ $post->reviews->count() }}</td>
                            <td>
                                <a class="action-link btn btn-sm btn-outline-primary"
                                   href="{{ route('review.show', ['category_id' => $category->id, 'post_id' => $post->id]) }}">
                                    Xem & Gửi nhận xét
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
