<?php

 use App\Http\Controllers\DashboardController;
 use App\Http\Controllers\ProfileController;
 use App\Http\Controllers\PostController;
 use App\Http\Controllers\CategoryController;
 use App\Http\Controllers\PublicController;
 use App\Http\Controllers\UserController;
 use App\Http\Controllers\HomeController;
 use Illuminate\Support\Facades\Route;

 // Homepage
 Route::get('/', [HomeController::class, 'index']);

 // Auth routes (from Laravel Breeze or Jetstream)
 require __DIR__ . '/auth.php';


 // 🔐 Routes for any authenticated user
 Route::middleware('auth')->group(function () {
     Route::get('/dashboard', DashboardController::class)->name('dashboard');

     // Profile
     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     // Everyone can view category list
     Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
 });


 // 👑 Admin-only routes
 Route::middleware(['auth', 'role:admin'])->group(function () {
     Route::resource('categories', CategoryController::class)->except(['index']);

     Route::prefix('admin')->name('admin.')->group(function () {
         Route::get('/users', [UserController::class, 'index'])->name('users.index');
         Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('users.assignRole');
     });
 });


 // ✍️ Admin + Author routes for managing posts (full CRUD)
 Route::middleware(['auth', 'role:admin,author'])->group(function () {
     Route::resource('posts', PostController::class);
 });


 // 👁 Viewer-only post reading routes
 Route::middleware(['auth', 'role:viewer'])->group(function () {
     Route::get('/read-posts', [PublicController::class, 'index'])->name('read-posts.index');
     Route::get('/read-posts/{post}', [PublicController::class, 'show'])->name('read-posts.show');
 });
