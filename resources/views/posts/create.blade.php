 @extends('layouts.app')

 @section('content')
 <div class="max-w-xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
     <h1 class="text-3xl font-bold text-gray-900 mb-6">Create Post</h1>

     <form action="{{ route('posts.store') }}" method="POST" class="space-y-6 bg-white p-6 rounded-xl shadow-md">
         @csrf

         {{-- Title Field --}}
         <div>
             <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
             <input id="title" name="title" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
         </div>

         {{-- Content Field --}}
         <div>
             <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
             <textarea id="content" name="content" rows="5" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
         </div>

         {{-- Category Dropdown --}}
         <div>
             <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
             <select id="category_id" name="category_id" required
                 class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                 @foreach(\App\Models\Category::all() as $category)
                     <option value="{{ $category->id }}">{{ $category->name }}</option>
                 @endforeach
             </select>
         </div>

         {{-- Submit Button --}}
         <div>
             <button type="submit"
                 class="inline-flex items-center px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                 Save
             </button>
         </div>
     </form>
 </div>
 @endsection
