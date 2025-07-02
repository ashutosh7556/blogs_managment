@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">
        {{ $post ? '✏️ Edit Post' : '➕ Create Post' }}
    </h1>

    <form
        method="POST"
        action="{{ $post ? route('posts.update', $post) : route('posts.store') }}"
        class="space-y-6 bg-white p-6 rounded-xl shadow-md"
    >
        @csrf
        @if($post)
            @method('PUT')
        @endif

        {{-- Title --}}
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input
                id="title"
                name="title"
                type="text"
                value="{{ old('title', $post->title ?? '') }}"
                required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            />
        </div>

        {{-- Content --}}
        <div>
            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
            <textarea
                id="content"
                name="content"
                rows="5"
                required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            >{{ old('content', $post->content ?? '') }}</textarea>
        </div>

        {{-- Category --}}
        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
            <select
                id="category_id"
                name="category_id"
                required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            >
                <option disabled {{ old('category_id', $post->category_id ?? '') ? '' : 'selected' }}>-- Choose a category --</option>
                @foreach($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id', $post->category_id ?? '') == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Submit --}}
        <div>
            <button
                type="submit"
                class="inline-flex items-center px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
            >
                {{ $post ? '💾 Update Post' : '📤 Create Post' }}
            </button>
        </div>
    </form>
</div>
@endsection
