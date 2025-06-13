<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Role;

class DashboardController extends Controller
{
public function __invoke()
{
return view('dashboard', [
'totalPosts' => Post::count(),
'totalCategories' => Category::count(),
'roles' => Role::withCount('users')->get(),
]);
}
}
