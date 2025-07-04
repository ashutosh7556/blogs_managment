 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="csrf-token" content="{{ csrf_token() }}">

     <title>{{ config('app.name', 'Laravel') }}</title>

     <!-- Fonts -->
     <link rel="preconnect" href="https://fonts.bunny.net">
     <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

     <!-- Tailwind & JS (via Vite) -->
     @vite(['resources/css/app.css', 'resources/js/app.js'])
 </head>
 <body class="bg-gradient-to-br from-indigo-100 via-white to-blue-100 min-h-screen font-sans text-gray-900 antialiased">

     <div class="min-h-screen flex flex-col items-center justify-center p-6">

         <!-- Logo or Title -->
         <div class="mb-8">
             <a href="/" class="text-4xl font-extrabold bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 text-transparent bg-clip-text hover:opacity-80 transition duration-300">
                 BlogNest
             </a>
         </div>

         <!-- Content Card -->
         <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-6 space-y-4">
             {{ $slot }}
         </div>

     </div>

 </body>
 </html>
