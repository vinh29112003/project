<!DOCTYPE html>
<html>
<head>
    <title>Thêm Danh Mục</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f1f1;
        }

        h2 {
            text-align: center;
            margin-top: 30px;
        }

        form {
            width: 50%;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #3490dc;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2779bd;
        }

        .alert {
            width: 50%;
            margin: 10px auto;
            padding: 10px;
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <h2>Thêm Danh Mục Mới</h2>

    @if ($errors->any())
        <div class="alert">
            <ul style="margin: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('categories.store')}}" method="POST">
        @csrf
        <label for="name">Tên danh mục</label>
        <input type="text" name="name" id="name"  required>

        <label for="description">Mô tả</label>
        <textarea name="description" id="description" rows="4"></textarea>

        <button type="submit">Thêm danh mục</button>
    </form>

</body>
</html>
