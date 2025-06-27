@extends('layouts.app')

@section('title', 'Dashboard')

@section('header')
📊 Dashboard
@endsection

@section('content')
  @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('author'))
      <div class="bg-gradient-to-r from-blue-50 to-white p-6 rounded-2xl shadow-md border border-blue-100 mb-6">
          <h2 class="text-xl font-bold text-blue-800 mb-4">🛠 Management Tools</h2>
          <ul class="list-disc pl-6 text-blue-700 space-y-1">
              <li>
                  <a href="{{ route('posts.index') }}" class="hover:underline hover:text-blue-900">
                      Manage Posts
                  </a>
              </li>
              <li>
                  <a href="{{ route('categories.index') }}" class="hover:underline hover:text-blue-900">
                      Manage Categories
                  </a>
              </li>
              @if(auth()->user()->hasRole('admin'))
                  <li>
                      <a href="{{ route('admin.users.index') }}" class="hover:underline hover:text-blue-900">
                          Manage User Roles
                      </a>
                  </li>

              @endif
          </ul>
      </div>
  @endif


<div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 mb-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-2">👋 Welcome, {{ auth()->user()->name }}!</h2>
    <p class="text-gray-600">
        You are logged in as:
        <span class="font-medium text-indigo-600">{{ auth()->user()->roles->pluck('name')->implode(', ') }}</span>
    </p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-xl shadow-md text-center hover:shadow-lg transition">
        <h3 class="text-lg font-semibold text-gray-700 mb-1">📝 Total Posts</h3>
        <p class="text-4xl font-bold text-indigo-600">{{ $totalPosts ?? 0 }}</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md text-center hover:shadow-lg transition">
        <h3 class="text-lg font-semibold text-gray-700 mb-1">📂 Total Categories</h3>
        <p class="text-4xl font-bold text-indigo-600">{{ $totalCategories ?? 0 }}</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md">
        <h3 class="text-lg font-semibold text-gray-700 mb-3">👥 Users by Role</h3>
        <ul class="space-y-1 text-gray-700">
            @forelse($roles ?? [] as $role)
            <li><strong>{{ $role->name }}</strong>: {{ $role->users_count }}</li>
            @empty
            <li class="text-gray-500">No roles found.</li>
            @endforelse
        </ul>
    </div>
</div>

@endsection
