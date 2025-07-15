 {{-- View link: Visible to everyone --}}
 <a href="{{ route('posts.show', $post) }}"
    class="text-green-500 hover:underline mr-2">
    View
 </a>

 {{-- Edit link: Only visible if user can update --}}
 @can('update', $post)
      <a href="{{ route('posts.edit', $post->id) }}" class="text-blue-500 hover:underline mr-2">
           Edit
      </a>

 @endcan

 {{-- Delete form: Only visible if user can delete --}}
 @can('delete', $post)
     <form action="{{ route('posts.destroy', $post) }}"
           method="POST"
           class="inline">
         @csrf
         @method('DELETE')

          <button type="submit"
                 onclick="return confirm('Are you sure you want to delete this post?')"
                 class="text-red-500 hover:underline">
             Delete
         </button>
     </form>
 @endcan
