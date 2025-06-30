 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="csrf-token" content="{{ csrf_token() }}">

     <title>@yield('title', 'Dashboard')</title>

     <!-- Fonts -->
     <link rel="preconnect" href="https://fonts.bunny.net">
     <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

     <!-- Styles -->
     @vite(['resources/css/app.css', 'resources/js/app.js'])


     <!-- Livewire Styles (must come AFTER vite for Alpine injection to work) -->
     @livewireStyles

     <style>
         body {
             background: linear-gradient(to right top, #dfe9f3, #ffffff);
         }
     </style>
 </head>

 <body class="font-sans antialiased text-gray-900">

     {{-- Navigation --}}
     @include('layouts.navigation')

     {{-- Page Header --}}
     <header class="bg-white/80 backdrop-blur-lg shadow-lg rounded-b-2xl mb-8">
         <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
             <h1 class="text-3xl font-bold text-gray-800">
                 @hasSection('header')
                     @yield('header')
                 @elseif (isset($header))
                     {{ $header }}
                 @endif
             </h1>

             @hasSection('action')
                 <div>@yield('action')</div>
             @endif
         </div>
     </header>

     {{-- Page Content --}}
     <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
         @hasSection('content')
             @yield('content')
         @else
             {{ $slot ?? '' }}
         @endif
     </main>

     {{-- Livewire Scripts --}}
     @livewireScripts
     @livewireScriptConfig
 </body>

 </html>
