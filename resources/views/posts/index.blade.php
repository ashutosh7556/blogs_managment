 @extends('layouts.app')

 @section('content')
 <div class="max-w-6xl mx-auto py-8 px-4" x-data="{ showForm: false }">

     <div class="flex justify-between items-center mb-6">
         <h1 class="text-2xl font-semibold text-gray-800">Post Manager</h1>

         <button @click="showForm = !showForm"
                 class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700 transition">
             <span x-text="showForm ? 'Back to Table' : '+ New Post'"></span>
         </button>
     </div>

     {{-- Form --}}
     <div x-show="showForm" x-transition class="mb-6">
         @livewire('post-form', [], key('form-create'))
     </div>

     {{-- Table --}}
     <div x-show="!showForm" x-transition>
         @livewire('post-table')
     </div>

 </div>

 <script>
     Livewire.on('post-created', () => {
         // Hide form after saving
         document.querySelector('[x-data]').__x.$data.showForm = false;
     });

     Livewire.on('editPost', (postId) => {
         // Remount form with postId
         Livewire.emit('mount', postId);
         document.querySelector('[x-data]').__x.$data.showForm = true;
     });
 </script>
 @endsection
