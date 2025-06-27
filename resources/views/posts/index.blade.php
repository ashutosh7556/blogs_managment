 @extends('layouts.app')

 @section('content')
 <div class="max-w-5xl mx-auto py-8">
     <div class="flex items-center justify-between mb-6">
         <h1 class="text-3xl font-semibold text-gray-800">Post Manager</h1>

         @can('create', App\Models\Post::class)
             <a href="{{ route('posts.create') }}"
                class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700 shadow-sm">
                 + New Post
             </a>
         @endcan
     </div>

     <div class="w-full flex justify-center">
         <div class="w-full max-w-7xl bg-white border border-gray-200 rounded-lg shadow-sm p-4">
             @livewire('post-table')
         </div>
     </div>

 </div>
 @endsection
