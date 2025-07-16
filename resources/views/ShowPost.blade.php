<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách Bài viết</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-4">

        <!-- Tiêu đề và nút đăng nhập/đăng xuất -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Danh sách Bài viết</h2>

            <div>
                {{-- Nếu CHƯA đăng nhập thì hiện nút Đăng nhập --}}
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary">Đăng nhập</a>
                @endguest

                {{-- Nếu ĐÃ đăng nhập thì hiện nút Đăng xuất --}}
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Đăng xuất</button>
                    </form>
                @endauth
            </div>
        </div>

        <!-- Bảng danh sách bài viết -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>STT</th>
                        <th>Bài viết</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $post->title ?? 'Không có' }}</td>
                            <td>
                                <a href="{{ route('post.index', ['category_id' => $category->id, 'post_id' => $post->id]) }}" class="btn btn-outline-info btn-sm">
                                    Chi tiết bài viết
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">Không có bài viết nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap Bundle JS (nếu cần tương tác JS như dropdown, modal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
