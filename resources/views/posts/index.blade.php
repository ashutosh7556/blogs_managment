@extends('layouts.app')

@section('title', 'Post Manager')

@section('header')
🗂 Post Manager
@endsection

@section('content')
@if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Author'))
<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('posts.create') }}" class="btn btn-primary">
        ➕ Create Post
    </a>
</div>
@endif

<livewire:post-table />

 @endsection
