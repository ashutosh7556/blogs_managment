 @extends('layouts.app')

 @section('title', 'Dashboard')

 @section('header')
     📊 Dashboard
 @endsection

 @section('content')
     <div class="min-h-screen bg-gradient-to-br from-gray-100 via-white to-gray-100 py-6 px-4 sm:px-8">
         <!-- Welcome Box -->
         <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200 mb-10">
             <h2 class="text-2xl font-semibold text-gray-800 mb-1">
                 👋 Welcome, {{ auth()->user()->name }}!
             </h2>
             <p class="text-gray-600 text-sm">
                 You are logged in as:
                 <span class="font-medium text-indigo-600">
                     {{ auth()->user()->roles->pluck('name')->implode(', ') }}
                 </span>
             </p>
         </div>


         <!-- Stats -->
         <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-10">
             <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition text-center">
                 <h3 class="text-lg font-semibold text-gray-700 mb-1">📝 Total Posts</h3>
                 <p class="text-4xl font-bold text-blue-600">{{ $totalPosts ?? 0 }}</p>
             </div>

             <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition text-center">
                 <h3 class="text-lg font-semibold text-gray-700 mb-1">📂 Total Categories</h3>
                 <p class="text-4xl font-bold text-yellow-500">{{ $totalCategories ?? 0 }}</p>
             </div>

             @if(auth()->user()->hasRole('admin'))
                 <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
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

          <!-- Posts vs Categories Pie Chart -->
          <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 mb-10">
              <h2 class="text-lg font-semibold text-gray-700 mb-4">📊 Posts vs Categories</h2>

              <div class="flex justify-center">
                  <div class="flex flex-col items-center space-y-4">
                      <div class="relative w-52 h-52"> <!-- Increased from w-32 h-32 -->
                          <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                              <!-- Background Circle -->
                              <circle
                                  cx="18" cy="18" r="15.9155"
                                  fill="none"
                                  stroke="#e5e7eb"
                                  stroke-width="4"
                              />

                              <!-- Post Ring -->
                              <path
                                  stroke="#6366f1"
                                  stroke-width="4"
                                  fill="none"
                                  stroke-dasharray="{{ $postPercent }}, 100"
                                  d="M18 2.0845
                                     a 15.9155 15.9155 0 0 1 0 31.831
                                     a 15.9155 15.9155 0 0 1 0 -31.831"
                              />

                              <!-- Category Ring -->
                              <path
                                  stroke="#f59e0b"
                                  stroke-width="4"
                                  fill="none"
                                  stroke-dasharray="{{ $categoryPercent }}, 100"
                                  stroke-dashoffset="-{{ $postPercent }}"
                                  d="M18 2.0845
                                     a 15.9155 15.9155 0 0 1 0 31.831
                                     a 15.9155 15.9155 0 0 1 0 -31.831"
                              />
                          </svg>

                          <div class="absolute inset-0 flex flex-col items-center justify-center">
                              <span class="text-2xl font-bold text-indigo-600">{{ $postPercent }}%</span> <!-- Slightly bigger text -->
                              <span class="text-base text-gray-500">Posts</span>
                          </div>
                      </div>


                      <div class="text-sm text-gray-600">
                          <div><span class="font-medium text-indigo-600">Posts:</span> {{ $totalPosts }}</div>
                          <div><span class="font-medium text-yellow-500">Categories:</span> {{ $totalCategories }}</div>
                      </div>
                  </div>
              </div>
          </div>


 @endsection
