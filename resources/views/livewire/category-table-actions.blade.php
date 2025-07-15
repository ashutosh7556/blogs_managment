 @if(auth()->user()->hasRole('admin'))
 <div class="flex space-x-2 items-center">
     <a
         href="{{ route('categories.edit', $category->id) }}"
         class="text-blue-600 hover:underline text-sm"
     >
         Edit
     </a>

     <form
         action="{{ route('categories.destroy', $category->id) }}"
         method="POST"
         onsubmit="return confirm('Are you sure you want to delete this category?');"
     >
         @csrf
         @method('DELETE')
         <button type="submit" class="text-red-600 hover:underline text-sm">
             Delete
         </button>
     </form>
 </div>
@endif
