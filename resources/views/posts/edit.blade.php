<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    <!-- ✅ Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">

<div class="container">
    <h1 class="mb-4 fw-bold text-primary">✏️ Edit Post</h1>

    <!-- Show validation errors -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('posts.update', $post) }}" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title', $post->title) }}"
                class="form-control"
                required
            >
        </div>

        <!-- Contents -->
        <div class="mb-3">
            <label for="contents" class="form-label">Content</label>
            <textarea
                id="contents"
                name="content"
                class="form-control"
                rows="5"
                required
            >{{ old('content', $post->content) }}</textarea>
        </div>

        <!-- Category -->
        <div class="mb-4">
            <label for="category_id" class="form-label">Category</label>
            <select id="category_id" name="category_id" class="form-select" required>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary w-100">
            💾 Update Post
        </button>
    </form>
</div>

<!-- Optional Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
