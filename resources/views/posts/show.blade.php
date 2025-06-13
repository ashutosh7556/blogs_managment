<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $post->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #fdfcfb, #e2d1c3);
            min-height: 100vh;
            padding: 40px;
            font-family: 'Segoe UI', sans-serif;
        }

        .post-container {
            max-width: 800px;
            margin: auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .post-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .post-category {
            font-style: italic;
            color: #7f8c8d;
            margin-bottom: 30px;
        }

        .post-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #34495e;
        }
    </style>
</head>
<body>

<div class="post-container">
    <h1 class="post-title">{{ $post->title }}</h1>
    <p class="post-category">Category: {{ $post->category->name }}</p>
    <p class="post-content">{{ $post->contents }}</p>
</div>

</body>
</html>
