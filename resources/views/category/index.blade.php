<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách danh mục</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

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
            width: 80%;
            margin: 0 auto;
        }

        #Add {
            display: block;
            margin: 0 auto 20px;
        }

        .auth-buttons {
            text-align: right;
            padding: 15px 40px 0 40px;
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

    <h2>Danh sách danh mục</h2>

    <div class="table-container">
        <a href="{{ route('categories.create') }}" class="btn btn-success" id="Add">
            + Thêm danh mục
        </a>

        <table class="table table-bordered table-hover bg-white shadow-sm">
            <thead class="table-light">
                <tr>
                    <th>STT</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->created_at->format('d/m/Y') }}</td>
                        <td>
                            {{-- Xem bài viết --}}
                            
                                <form action="{{ route('categories.posts.index', $category->id) }}" method="GET"
                                    class="d-inline">
                                    <button type="submit" class="btn btn-outline-info btn-sm mb-1">
                                        <i class="bi bi-eye"></i> Xem bài viết
                                    </button>
                                </form>
            

                            {{-- Sửa --}}
                            @can('update', $category)
                                <form action="{{ route('categories.edit', $category->id) }}" method="GET" class="d-inline">
                                    <button type="submit" class="btn btn-warning btn-sm mb-1">
                                        <i class="bi bi-pencil-square"></i> Sửa
                                    </button>
                                </form>
                            @endcan

                            {{-- Xoá --}}
                            @can('delete', $category)
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xoá danh mục này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Xoá
                                    </button>
                                </form>
                            @endcan
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>