 @extends('layouts.app')

 @section('content')
 <div class="max-w-xl mx-auto py-8">
     <h1 class="text-2xl font-bold mb-4">Create Post</h1>

     <form action="{{ route('posts.store') }}" method="POST" class="space-y-4">
         @csrf

         {{-- Title Field --}}
         <div>
             <label class="block text-sm font-medium text-gray-700">Title</label>
             <input name="title" class="w-full border rounded p-2" required>
         </div>

         {{-- Content Field --}}
         <div>
             <label class="block text-sm font-medium text-gray-700">Content</label>
             <textarea name="content" rows="5" class="w-full border rounded p-2" required></textarea>
         </div>

         {{-- Category Dropdown --}}
         <div>
             <label class="block text-sm font-medium text-gray-700">Category</label>
             <select name="category_id" class="w-full border rounded p-2" required>
                 @foreach(\App\Models\Category::all() as $category)
                     <option value="{{ $category->id }}">{{ $category->name }}</option>
                 @endforeach
             </select>
         </div>

         {{-- Submit Button --}}
         <button class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
             Save
         </button>
     </form>
 </div>
 @endsection
