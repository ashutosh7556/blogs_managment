<?php

 namespace App\Http\Controllers;

 use App\Models\Post;
 use App\Models\Category;
 use Spatie\Permission\Models\Role;

 class DashboardController extends Controller
 {
     public function __invoke()
     {
         $user = auth()->user();

         // Everyone sees total post & category count
         $totalPosts = Post::count();
         $totalCategories = Category::count();

         // Only admin sees role breakdown
         $roles = $user->hasRole('admin')
             ? Role::withCount('users')->get()
             : null;

         return view('dashboard', compact('totalPosts', 'totalCategories', 'roles'));
     }
 }
