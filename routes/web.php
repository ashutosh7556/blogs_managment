<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
return view('welcome');
});

require __DIR__.'/auth.php';

// 🔐 Authenticated user routes
Route::middleware('auth')->group(function () {
Route::get('/dashboard', DashboardController::class)->name('dashboard');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🛠 Admin-only routes
Route::middleware(['auth', 'role:admin'])->group(function () {
Route::resource('categories', CategoryController::class);
Route::post('/users/{user}/assign-role', [UserController::class, 'assignRole'])->name('users.assignRole');
});

// ✍️ Admin + Author routes
Route::middleware(['auth', 'role:admin,author'])->group(function () {
Route::resource('posts', PostController::class);
});

// 👁 Viewer-only routes
Route::middleware(['auth', 'role:viewer'])->group(function () {
Route::get('/read-posts', [PublicController::class, 'index']);
});

Route::get('/read-posts/{post}', [PublicController::class, 'show']);
