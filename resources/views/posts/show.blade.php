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
             background: #ef4444; /* red margin line */
         }
     </style>
 </head>
 <body class="py-12 px-4 sm:px-6 lg:px-8">

      <div class="max-w-3xl mx-auto shadow-lg border border-gray-300 rounded-lg overflow-hidden notebook-paper p-10 relative">
          <!-- Post Title -->
          <h1 class="text-3xl font-bold text-gray-800 mb-4 pl-12">
              {{ $post->title }}
          </h1>

          <!-- Category -->
          <p class="italic text-sm text-gray-600 mb-6 pl-12">
              Category: {{ $post->category->name }}
          </p>

          <!-- Post Content -->
          <div class="text-gray-800 text-lg leading-loose whitespace-pre-line pl-12">
              {!! nl2br(e($post->content)) !!}
          </div>
      </div>


 </body>
 </html>
