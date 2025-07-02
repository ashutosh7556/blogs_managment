 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <title>{{ $post->title }}</title>
     <script src="https://cdn.tailwindcss.com"></script>
     <link href="https://fonts.googleapis.com/css2?family=Handlee&display=swap" rel="stylesheet">
     <style>
         body {
             background-color: #f3f4f6;
             font-family: 'Handlee', cursive;
         }

         .notebook-paper {
             background: repeating-linear-gradient(
                 to bottom,
                 #ffffff,
                 #ffffff 24px,
                 #cbd5e0 25px
             );
             position: relative;
         }

         .notebook-paper::before {
             content: "";
             position: absolute;
             left: 40px;
             top: 0;
             bottom: 0;
             width: 2px;
             background: #ef4444;
         }
     </style>
 </head>
 <body class="py-12 px-4 sm:px-6 lg:px-8">

     <div class="max-w-3xl mx-auto shadow-lg border border-gray-300 rounded-lg overflow-hidden notebook-paper p-10 relative">
         <!-- Post Title -->
         <h1 class="text-3xl font-bold text-gray-800 mb-4 pl-12">
             {{ $post->title }}
         </h1>

       <!-- Post image -->
     @if($post->image)
         <div class="pl-12 mb-6">
             <img src="{{ asset('storage/' . $post->image) }}" alt="Post image" class="rounded-lg shadow-md max-w-full h-auto">
         </div>
     @endif


         <!-- Category -->
         <p class="italic text-sm text-gray-600 mb-6 pl-12">
             Category: {{ $post->category->name }}
         </p>

         <!-- Post Content -->
         <div class="text-gray-800 text-lg leading-loose whitespace-pre-line pl-12">
             {!! nl2br(e($post->content)) !!}
         </div>

         <!-- Feedback Section -->
         <div class="mt-10 bg-white shadow-lg border border-gray-300 rounded-lg p-6">
             <h2 class="text-2xl font-semibold mb-4 text-gray-700">Leave Feedback</h2>

             @if(session('success'))
                 <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                     {{ session('success') }}
                 </div>
             @endif

             <form action="{{ route('feedback.store', $post->id) }}" method="POST">
                 @csrf

                 <div>
                     <label class="block text-sm font-medium text-gray-700">Your Name (optional):</label>
                     <input type="text" name="name" class="mt-1 block w-full border border-gray-300 rounded p-2">
                 </div>

                 <div>
                     <label class="block text-sm font-medium text-gray-700">Your Feedback:</label>
                     <textarea name="content" rows="3" required class="mt-1 block w-full border border-gray-300 rounded p-2"></textarea>
                 </div>

                 <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                     Submit Feedback
                 </button>
             </form>

         </div>

         <!-- Display Existing Feedback -->
         <div class="mt-6">
             <h3 class="text-xl font-semibold text-gray-700 mb-4">User Feedback</h3>

             @forelse($post->feedback as $fb)
                 <div class="bg-white shadow border border-gray-200 rounded-lg p-4 mb-3">
                     <p class="font-medium text-gray-800">{{ $fb->name ?? $fb->user->name ?? 'Anonymous' }}</p>
                     <p class="text-gray-700 mt-1">{{ $fb->content }}</p>
                     <small class="text-gray-500">{{ $fb->created_at->diffForHumans() }}</small>
                 </div>
             @empty
                 <p class="text-gray-600 italic">No feedback yet. Be the first to leave a comment!</p>
             @endforelse
         </div>
     </div>

 </body>
 </html>
