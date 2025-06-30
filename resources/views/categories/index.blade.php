@extends('layouts.app')

@section('content')


<div class="max-w-6xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Categories</h1>
         @if(auth()->user()->hasRole('admin'))
        <a href="{{ route('categories.create') }}"
           class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
            +  New Category
        </a>
    @endif
    </div>

 <livewire:category-table />

</div>
@endsection
