<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách Bài viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8fafc;
        }

        h2 {
            text-align: center;
            margin: 30px 0 20px;
            color: #2c3e50;
        }

        .table-container {
            width: 95%;
            margin: 0 auto;
        }

        table img {
            border-radius: 6px;
            object-fit: cover;
            height: 100px;
            width: 150px;
        }

        #Add {
            margin: 0 auto 20px;
            display: block;
        }

        .auth-buttons {
            text-align: right;
            padding: 15px 40px 0 40px;
        }

        @media (max-width: 768px) {
            table img {
                width: 100px;
                height: auto;
            }
        }
    </style>
</head>

<body>

    <div class="auth-buttons">
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

    <h2>Danh sách Bài viết</h2>

    <div class="table-container">
        <a href="{{ route('categories.posts.create', ['category' => $category->id]) }}" class="btn btn-success"
            id="Add">
            + Thêm bài viết
        </a>

        <table class="table table-bordered table-hover bg-white shadow-sm">
            <thead class="table-light">
                <tr>
                    <th>STT</th>
                    <th>Hình ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Nội dung</th>
                    <th>Danh mục</th>
                    <th>Trạng thái</th>
                    <th>Lượt nhận xét</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}">
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>{{ Str::limit($post->content, 50) }}</td>
                        <td>{{ $post->category->name ?? 'Không có' }}</td>
                        <td>{{ $post->status->name ?? 'Không có' }}</td>
                        <td>{{ $post->reviews->count() }}</td>
                        <td>
                            {{-- Xem & Gửi nhận xét --}}
                            <form action="{{ route('categories.posts.reviews.index', [$post->category_id, $post->id]) }}"
                                method="GET" class="d-inline">
                                <button type="submit" class="btn btn-sm btn-outline-primary mb-1">
                                    Nhận xét
                                </button>
                            </form>

                            {{-- Sửa (nếu muốn dùng) --}}

                            <form
                                action="{{ route('categories.posts.edit', ['category' => $post->category_id, 'post' => $post->id]) }}"
                                method="GET" class="d-inline">
                                <button type="submit" class="btn btn-sm btn-outline-success mb-1">
                                    Sửa
                                </button>
                            </form>


                            {{-- Xoá (nếu muốn dùng) --}}

                            <form action="{{ route('categories.posts.destroy', ['category' => $post->category_id, 'post' => $post->id])
                                 }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Bạn có chắc muốn xoá bài viết này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    Xoá
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>