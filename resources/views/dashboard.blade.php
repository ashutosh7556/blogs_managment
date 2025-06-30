 @extends('layouts.app')

 @section('title', 'Dashboard')

 @section('header')
     📊 Dashboard
 @endsection

 @section('content')

     <!-- Tailwind test box -->


     @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('author'))
         <div class="bg-gradient-to-r from-indigo-50 to-white p-6 rounded-2xl shadow-md border border-indigo-100 mb-10">
             <h2 class="text-xl font-semibold text-indigo-800 mb-4 flex items-center gap-2">
                 🛠 Management Tools
             </h2>
             <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3">
                 <a href="{{ route('posts.index') }}"
                    class="flex items-center gap-3 p-4 rounded-xl bg-white shadow-sm border hover:shadow-md transition group">
                     <span class="text-2xl">📝</span>
                     <div>
                         <p class="text-sm text-gray-500 group-hover:text-indigo-600">Posts</p>
                         <h4 class="text-base font-medium text-gray-700 group-hover:text-indigo-800">Manage Posts</h4>
                     </div>
                 </a>

                 <a href="{{ route('categories.index') }}"
                    class="flex items-center gap-3 p-4 rounded-xl bg-white shadow-sm border hover:shadow-md transition group">
                     <span class="text-2xl">📂</span>
                     <div>
                         <p class="text-sm text-gray-500 group-hover:text-indigo-600">Categories</p>
                         <h4 class="text-base font-medium text-gray-700 group-hover:text-indigo-800">Manage Categories</h4>
                     </div>
                 </a>

                 @if(auth()->user()->hasRole('admin'))
                     <a href="{{ route('admin.users.index') }}"
                        class="flex items-center gap-3 p-4 rounded-xl bg-white shadow-sm border hover:shadow-md transition group">
                         <span class="text-2xl">👥</span>
                         <div>
                             <p class="text-sm text-gray-500 group-hover:text-indigo-600">Users</p>
                             <h4 class="text-base font-medium text-gray-700 group-hover:text-indigo-800">User Roles</h4>
                         </div>
                     </a>
                 @endif
             </div>
         </div>
     @endif

     <!-- Welcome Box -->
     <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 mb-10">
         <h2 class="text-2xl font-semibold text-gray-800 mb-1">👋 Welcome, {{ auth()->user()->name }}!</h2>
         <p class="text-gray-600 text-sm">
             You are logged in as:
             <span class="font-medium text-indigo-600">
                 {{ auth()->user()->roles->pluck('name')->implode(', ') }}
             </span>
         </p>
     </div>

     <!-- Stats -->
     <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
         <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition text-center">
             <h3 class="text-lg font-semibold text-gray-700 mb-1">📝 Total Posts</h3>
             <p class="text-4xl font-bold text-indigo-600">{{ $totalPosts ?? 0 }}</p>
         </div>

         <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition text-center">
             <h3 class="text-lg font-semibold text-gray-700 mb-1">📂 Total Categories</h3>
             <p class="text-4xl font-bold text-indigo-600">{{ $totalCategories ?? 0 }}</p>
         </div>

         @if(auth()->user()->hasRole('admin'))
             <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
                 <h3 class="text-lg font-semibold text-gray-700 mb-3">👥 Users by Role</h3>
                 <ul class="space-y-2 text-gray-700">
                     @forelse($roles as $role)
                         <li class="flex justify-between">
                             <span class="text-gray-800 font-medium">{{ ucfirst($role->name) }}</span>
                             <span class="text-indigo-600 font-semibold">{{ $role->users_count }}</span>
                         </li>
                     @empty
                         <li class="text-gray-500 italic">No roles found.</li>
                     @endforelse
                 </ul>
             </div>
         @endif
     </div>

 @endsection
