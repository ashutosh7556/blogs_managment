<?php

 use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\DashboardController;
 use App\Http\Controllers\ProfileController;
 use App\Http\Controllers\PostController;
 use App\Http\Controllers\CategoryController;
 use App\Http\Controllers\PublicController;
 use App\Http\Controllers\UserController;
 use App\Http\Controllers\HomeController;
 use App\Livewire\PostForm; // 👈 Livewire component for create/edit

 // 🏠 Public homepage
 Route::get('/', [HomeController::class, 'index']);

 // 🔐 Auth routes (Jetstream or Breeze)
 require __DIR__ . '/auth.php';

 // 🔐 All authenticated users
 Route::middleware('auth')->group(function () {
     Route::get('/dashboard', DashboardController::class)->name('dashboard');

     // Profile
     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     // Categories - index viewable by all authenticated
     Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
 });

 // 👑 Admin-only
 Route::middleware(['auth', 'role:admin'])->group(function () {
     Route::resource('categories', CategoryController::class)->except(['index']);

     Route::prefix('admin')->name('admin.')->group(function () {
         Route::get('/users', [UserController::class, 'index'])->name('users.index');
         Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('users.assignRole');
     });
 });

 // ✍️ Admin + Author: full CRUD (Livewire for create/edit)
 Route::middleware(['auth', 'role:admin,author'])->group(function () {
     // Post index, store, update, delete (controller)
     Route::resource('posts', PostController::class)->except(['show', 'create', 'edit']);

     // Post create & edit handled by Livewire (same component for both)
     Route::get('/posts/create', PostForm::class)->name('posts.create');
     Route::get('/posts/{postId}/edit', PostForm::class)->name('posts.edit');
 });

 // 👁️ All authenticated users can view individual posts
 Route::middleware(['auth'])->group(function () {
     Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
 });

 // 👁 Viewer-only custom post reading
 Route::middleware(['auth', 'role:viewer'])->group(function () {
     Route::get('/read-posts', [PublicController::class, 'index'])->name('read-posts.index');
     Route::get('/read-posts/{post}', [PublicController::class, 'show'])->name('read-posts.show');
 });
