<?php

 namespace App\Http\Controllers;

 use App\Models\Post;
 use App\Models\Category;
 use App\Models\Role; // ← your custom Role model

 class DashboardController extends Controller
 {
     public function __invoke()
     {
         $totalPosts = Post::count();
         $totalCategories = Category::count();

         $total = $totalPosts + $totalCategories;

         // Avoid division by zero
         $postPercent = $total > 0 ? round(($totalPosts / $total) * 100, 1) : 0;
         $categoryPercent = $total > 0 ? round(($totalCategories / $total) * 100, 1) : 0;

         // Load roles with number of users in each
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
