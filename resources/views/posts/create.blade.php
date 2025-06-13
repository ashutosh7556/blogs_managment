<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #dff9fb, #fceef5);
            min-height: 100vh;
            padding: 40px;
        }

        .form-container {
            max-width: 700px;
            margin: auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .form-container h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .btn-custom {
            background-color: #2980b9;
            color: white;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #1c5980;
        }

        .error-list {
            background-color: #ffe6e6;
            border-left: 5px solid #e74c3c;
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .error-list li {
            color: #c0392b;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Create Post</h1>

    {{-- Display validation errors --}}
    @if ($errors->any())
    <div class="error-list">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('posts.store') }}">
        @csrf

        {{-- Title --}}
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input
                type="text"
                class="form-control"
                id="title"
                name="title"
                value="{{ old('title') }}"
                placeholder="Enter post title"
                required
            >
        </div>

        {{-- Contents --}}
        <div class="mb-3">
            <label for="contents" class="form-label">Content</label>
            <textarea
                class="form-control"
                id="contents"
                name="contents"
                rows="6"
                placeholder="Write your post content here..."
                required
            >{{ old('contents') }}</textarea>
        </div>

        {{-- Category --}}
        <div class="mb-4">
            <label for="category_id" class="form-label">Category</label>
            <select
                class="form-select"
                name="category_id"
                id="category_id"
                required
            >
                <option value="" disabled selected>-- Select Category --</option>
                @foreach ($categories as $category)
                <option
                    value="{{ $category->id }}"
                    {{ old('category_id') == $category->id ? 'selected' : '' }}
                >
                {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-custom btn-lg">🚀 Submit Post</button>
        </div>
    </form>
</div>

</body>
</html>
