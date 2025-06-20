 @extends('layouts.app')

 @section('content')
 <div class="max-w-5xl mx-auto py-8">
     <div class="flex items-center justify-between mb-6">
         <h1 class="text-3xl font-semibold">Post Manager</h1>
         <a href="{{ route('posts.create') }}"
            class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
             + New Post
         </a>
     </div>

 @livewire('post-table')

 </div>
 @endsection
