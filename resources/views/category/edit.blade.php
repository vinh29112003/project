<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Category</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Category</h2>

    <form action="{{route('web.categories.update',[$category->id])}}" method="POST">
       @csrf
        @method('PUT') <!-- Laravel method spoofing for PUT request -->
        <div class="mb-3">
            <label for="name" class="form-label">Category Name:</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                class="form-control" 
                value="" 
                placeholder="Enter category name" 
                required
                value="{{$category->name}}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea 
                id="description" 
                name="description" 
                class="form-control" 
                rows="4" 
                placeholder="Enter description">{{$category->description}}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
        <a href="{{ route('web.categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
