@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto p-6">
    <h1 class="text-xl font-bold mb-4">Create Category</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @include('categories._form')
    </form>
</div>
@endsection
