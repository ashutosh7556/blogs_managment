<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog Posts') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @foreach ($posts as $post)
            <div class="mb-6 p-4 border rounded shadow">
                <h3 class="text-xl font-bold">{{ $post->title }}</h3>
                <p class="text-sm text-gray-500">
                    By {{ $post->user->name }} in {{ $post->category->name }}
                </p>
                <p class="mt-2 text-gray-700">
                    {{ \Illuminate\Support\Str::limit($post->content, 200) }}
                </p>
            </div>
            @endforeach

            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
