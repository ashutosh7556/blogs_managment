    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>BlogNest</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <meta name="description" content="BlogNest - Your daily dose of fresh stories, ideas, and insights." />
    </head>
    <body class="bg-gray-100 text-gray-800 antialiased">
    <div class="min-h-screen flex flex-col">

        <!-- Navbar -->
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <a href="/" class="text-2xl font-bold text-gray-800 hover:text-red-500 transition">BlogNest</a>
                <div class="space-x-4">
                    <a href="/login" class="text-gray-700 hover:text-red-500 font-medium transition">Login</a>
                    <a href="/register" class="text-gray-700 hover:text-red-500 font-medium transition">Register</a>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-16 px-6 text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900">Welcome to BlogNest</h1>
                <p class="mt-4 text-lg text-gray-600">Your daily dose of fresh stories, ideas, and insights.</p>
                <a href="#blogs" class="mt-6 inline-block bg-red-500 text-white px-6 py-3 rounded-lg hover:bg-red-600 transition">Explore Blogs</a>
            </div>
        </header>

        <!-- Blog Grid -->
        <main id="blogs" class="flex-1 py-12 px-6">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-2xl font-semibold mb-6 text-center md:text-left">Latest Posts</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                    <!-- Blog Card Component -->
                    <article class="bg-white rounded-lg shadow hover:shadow-2xl transition overflow-hidden">
                        <img src="https://source.unsplash.com/600x400/?nature,water" alt="Nature blog cover" class="w-full h-48 object-cover" />
                        <div class="p-6">
                            <h3 class="text-xl font-semibold">The Beauty of Nature</h3>
                            <p class="text-gray-600 mt-2">Explore the healing powers of natural environments and their impact on well-being.</p>
                            <a href="#" class="inline-block mt-4 text-red-500 hover:underline">Read more →</a>
                        </div>
                    </article>

                    <article class="bg-white rounded-lg shadow hover:shadow-2xl transition overflow-hidden">
                        <img src="https://source.unsplash.com/600x400/?technology,code" alt="Technology blog cover" class="w-full h-48 object-cover" />
                        <div class="p-6">
                            <h3 class="text-xl font-semibold">Top 10 Laravel Tips</h3>
                            <p class="text-gray-600 mt-2">Boost your productivity with these practical Laravel development tips.</p>
                            <a href="#" class="inline-block mt-4 text-red-500 hover:underline">Read more →</a>
                        </div>
                    </article>

                    <article class="bg-white rounded-lg shadow hover:shadow-2xl transition overflow-hidden">
                        <img src="https://source.unsplash.com/600x400/?writing,notebook" alt="Writing blog cover" class="w-full h-48 object-cover" />
                        <div class="p-6">
                            <h3 class="text-xl font-semibold">Writing as Therapy</h3>
                            <p class="text-gray-600 mt-2">Discover how expressive writing can improve mental clarity and health.</p>
                            <a href="#" class="inline-block mt-4 text-red-500 hover:underline">Read more →</a>
                        </div>
                    </article>

                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white shadow mt-12">
            <div class="max-w-7xl mx-auto py-6 px-6 text-center text-sm text-gray-500">
                &copy; 2025 <strong>BlogNest</strong>. All rights reserved.
            </div>
        </footer>

    </div>
    </body>
    </html>
