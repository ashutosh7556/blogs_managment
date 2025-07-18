 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: false }" x-cloak>
 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="csrf-token" content="{{ csrf_token() }}">

     <title>@yield('title', 'Dashboard')</title>

     <!-- Fonts -->
     <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

     <!-- Styles -->
     @vite(['resources/css/app.css', 'resources/js/app.js'])
     @livewireStyles

     <!-- Optional: Livewire loading fade style -->
     <style>
         [wire\:loading] {
             opacity: 0.5;
             pointer-events: none;
         }

         @keyframes home-spin {
             0%   { transform: rotate(0deg); }
             100% { transform: rotate(360deg); }
         }

         .animate-home-spin {
             animation: home-spin 2s linear infinite;
         }
     </style>
 </head>
 <body class="font-sans antialiased text-gray-800 bg-gradient-to-br from-indigo-100 via-white to-blue-100 min-h-screen">

 @if(session('success'))
     <div
         x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 3000)"
         x-show="show"
         x-transition
         class="bg-green-100 text-green-700 p-3 rounded mb-4"
     >
         {{ session('success') }}
     </div>
 @endif

 @if(auth()->user()->hasAnyRole(['admin', 'author']))
 <div class="flex min-h-screen">
     <!-- Sidebar -->
     <div :class="sidebarOpen ? 'w-64' : 'w-0'" class="transition-all duration-300 overflow-hidden bg-gray-900 shadow-lg text-white">
         <div class="p-6 space-y-3">
             <h2 class="text-lg font-bold text-white">Menu</h2>
             <a href="{{ route('dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-800">🏠 Dashboard</a>
             <a href="{{ route('posts.index') }}" class="block py-2 px-4 rounded hover:bg-gray-800">📝 Manage Posts</a>
             <a href="{{ route('categories.index') }}" class="block py-2 px-4 rounded hover:bg-gray-800">📂 Manage Categories</a>
             <a href="{{ route('feedback.index') }}" class="block py-2 px-4 rounded hover:bg-gray-800">📩 Messages</a>
             <a href="{{ route('user_chat') }}" class="block py-2 px-4 rounded hover:bg-gray-800">💬 ChatBox</a>
             @if(auth()->user()->hasRole('admin'))
                 <a href="{{ route('admin.users.index') }}" class="block py-2 px-4 rounded hover:bg-gray-800">👥 Manage Users</a>
             @endif
         </div>
     </div>
 @endif

     <!-- Main Content -->
     <div class="flex-1 flex flex-col transition-all duration-300">
         <!-- Navbar -->
         <nav class="bg-white border-b border-gray-200 px-4 py-4 shadow-sm">
             <div class="flex justify-between items-center">
                 <!-- Left -->
                 <div class="flex items-center space-x-4">
                     @if(auth()->user()->hasAnyRole(['admin', 'author']))
                         <!-- Menu Button -->
                         <button @click="sidebarOpen = !sidebarOpen"
                                 class="text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-300 rounded-md">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                  viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                 <path stroke-linecap="round" stroke-linejoin="round"
                                       d="M4 6h16M4 12h16M4 18h16"/>
                             </svg>
                         </button>
                         <a href="{{ route('home') }}" class="flex items-center gap-1 text-gray-700 hover:text-blue-600 transition duration-300">
                             <svg xmlns="http://www.w3.org/2000/svg"
                                  class="h-7 w-7 text-red-500 animate-home-spin"
                                  fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                 <path stroke-linecap="round" stroke-linejoin="round"
                                       d="M3 12l9-9 9 9M4 12v8a1 1 0 001 1h4a1 1 0 001-1v-5h4v5a1 1 0 001 1h4a1 1 0 001-1v-8" />
                             </svg>
                         </a>
                     @endif
                 </div>

                 <!-- Right -->
                 <div class="hidden sm:flex sm:items-center space-x-4">
                     @include('layouts.navigation') <!-- Logout button & user menu here -->
                 </div>
             </div>
         </nav>

         <!-- Page Content -->
         <main class="p-6 bg-gray-50 min-h-screen">
             @hasSection('header')
                 <h1 class="text-2xl font-bold text-gray-800 mb-4">@yield('header')</h1>
             @endif

             @hasSection('content')
                 @yield('content')
             @else
                 {{ $slot ?? '' }}
             @endif
         </main>
     </div>
 </div>

 @livewireScripts
 @stack('scripts')
 </body>
 </html>
