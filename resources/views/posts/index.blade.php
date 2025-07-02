 @extends('layouts.app')

 @section('content')
 <div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8" x-data="{ showForm: false }">

     <!-- Header with Toggle Button -->
     <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-8 gap-4">
         <h1 class="text-3xl font-bold text-indigo-800">📋 Post Manager</h1>

         <button @click="showForm = !showForm"
                 class="inline-flex items-center justify-center gap-2 bg-blue-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg shadow hover:bg-blue-800 transition focus:outline-none focus:ring-2 focus:ring-blue-500">
             <span x-text="showForm ? 'Back to Table' : 'New Post'"></span>
         </button>
     </div>

     <!-- Livewire Form -->
     <div x-show="showForm" x-transition.duration.300ms class="mb-6">
         @livewire('post-form', [], key('form-create'))
     </div>

     <!-- Livewire Table -->
     <div x-show="!showForm" x-transition.duration.300ms>
         @livewire('post-table')
     </div>
 </div>

 <!-- Alpine + Livewire Sync -->
 <script>
     Livewire.on('post-created', () => {
         document.querySelector('[x-data]').__x.$data.showForm = false;
     });

     Livewire.on('editPost', (postId) => {
         Livewire.emit('mount', postId);
         document.querySelector('[x-data]').__x.$data.showForm = true;
     });
 </script>
 @endsection
