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

         if ($user->hasRole('admin')) {
             $totalPosts = Post::count();
             $totalCategories = Category::count();
             $roles = Role::withCount('users')->get();
         } else {
             $totalPosts = Post::where('user_id', $user->id)->count();
             $totalCategories = Category::count(); // Optional: you can also limit categories shown if needed
             $roles = null;
         }

         return view('dashboard', compact('totalPosts', 'totalCategories', 'roles'));
     }
 }
