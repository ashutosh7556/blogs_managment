 <!DOCTYPE html>
 <html lang="en" class="scroll-smooth">
 <head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>BlogNest</title>
     <meta name="description" content="BlogNest – Your daily dose of fresh stories, ideas, and insights." />
     @vite(['resources/css/app.css', 'resources/js/app.js'])
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
     <style>
         body { font-family: 'Inter', sans-serif; }
     </style>
 </head>

 <body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

     {{-- Navbar --}}
     <nav class="bg-white shadow-md py-4">
         <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
              <a href="/" class="text-2xl font-bold bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 text-transparent bg-clip-text hover:opacity-80 transition">
                  BlogNest
              </a>

             <div class="space-x-3">
                 <a href="/login" class="px-4 py-2 border border-gray-400 text-gray-800 rounded-md hover:bg-gray-100 transition">Login</a>
                 <a href="/register" class="px-4 py-2 bg-purple-700 text-white rounded-md hover:bg-purple-800 transition">Register</a>
             </div>
         </div>
     </nav>

     {{-- Hero Section --}}
     <header class="bg-gradient-to-br from-indigo-500 to-purple-600 py-20 text-center text-white rounded-b-3xl">
         <h1 class="text-4xl md:text-5xl font-bold mb-4">Welcome to BlogNest</h1>
         <p class="text-lg md:text-xl max-w-2xl mx-auto px-4">
             Read inspiring posts, share your thoughts, and connect with curious minds.
         </p>
     </header>

     {{-- Main Content --}}
       <main class="flex-1 py-16 bg-gray-50">
           <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
               <h2 class="text-3xl font-bold text-center text-gray-800 mb-12 flex items-center justify-center">
                   <span class="text-yellow-500 text-4xl mr-2">✨</span> Latest Posts
               </h2>

               <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                   @foreach ($posts as $post)
                       <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col">
                           <div class="bg-indigo-100 text-indigo-800 font-semibold text-center py-8 px-4 text-xl tracking-wide uppercase">
                               {{ $post->title }}
                           </div>

                           <div class="p-6 flex flex-col flex-1">
                               <p class="text-gray-600 text-sm mb-4 flex-grow leading-relaxed">
                                   {{ \Illuminate\Support\Str::limit($post->content, 20) }}
                               </p>

                               <a href="{{ route('posts.show', $post) }}"
                                   class="inline-flex items-center text-indigo-600 font-medium hover:underline mt-auto">
                                   Read more
                                   <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                   </svg>
                               </a>
                           </div>
                       </div>
                   @endforeach
               </div>
           </div>
       </main>




     {{-- Footer --}}
     <footer class="bg-white border-t py-4 text-center text-gray-500 mt-auto">
         &copy; {{ date('Y') }} <span class="font-semibold text-gray-800">BlogNest</span>. All rights reserved.
     </footer>

 </body>
 </html>
