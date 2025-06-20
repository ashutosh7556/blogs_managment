@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto p-6">
    <h1 class="text-xl font-bold mb-4">Edit Category</h1>
    <form action="{{ route('categories.update', $category) }}" method="POST">
        @method('PUT')
        @include('categories._form', ['category' => $category])
    </form>
</div>
@endsection
