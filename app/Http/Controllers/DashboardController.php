<?php

 namespace App\Http\Controllers;

 use Illuminate\Support\Facades\Auth; // ✅ Required
 use App\Models\Post;
 use App\Models\Category;
 use App\Models\Role;

 class DashboardController extends Controller
 {
     public function __invoke()
     {
         $user = Auth::user();

         // 🚫 Redirect viewers to home
         if ($user->hasRole('viewer')) {
             return redirect('/'); // or route('home')
         }

         $totalPosts = Post::count();
         $totalCategories = Category::count();

         $total = $totalPosts + $totalCategories;

         $postPercent = $total > 0 ? round(($totalPosts / $total) * 100, 1) : 0;
         $categoryPercent = $total > 0 ? round(($totalCategories / $total) * 100, 1) : 0;

         // 📊 Load roles with number of users
         $roles = Role::withCount('users')->get();

         return view('dashboard', compact(
             'totalPosts',
             'totalCategories',
             'postPercent',
             'categoryPercent',
             'roles'
         ));
     }
 }
