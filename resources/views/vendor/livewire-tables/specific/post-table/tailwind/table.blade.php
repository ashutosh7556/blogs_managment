 <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">

     {{-- Search --}}
     @if ($searchable)
         <div class="w-full md:w-1/3">
             <input
                 wire:model.debounce.500ms="search"
                 type="text"
                 placeholder="Search..."
                 class="w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 focus:outline-none"
             />
         </div>
     @endif

     {{-- Per Page / Column Selector --}}
     <div class="flex flex-col md:flex-row md:items-center gap-2">

         {{-- Per Page Dropdown --}}
         @if ($paginationEnabled && $perPageOptions)
             <select wire:model="perPage"
                     class="rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 focus:outline-none">
                 @foreach ($perPageOptions as $value)
                     <option value="{{ $value }}">{{ $value }}</option>
                 @endforeach
             </select>
         @endif

         {{-- Column Select --}}
         @if ($showColumnSelect)
             <div class="relative">
                 @include('livewire-tables::components.tools.columns')
             </div>
         @endif
     </div>
 </div>
