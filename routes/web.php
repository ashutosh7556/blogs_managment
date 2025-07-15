<?php
 use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\DashboardController;
 use App\Http\Controllers\ProfileController;
 use App\Http\Controllers\PostController;
 use App\Http\Controllers\CategoryController;
 use App\Http\Controllers\PublicController;
 use App\Http\Controllers\UserController;
 use App\Http\Controllers\HomeController;
 use App\Livewire\PostForm;
 use App\Http\Controllers\FeedbackController;
 use App\Http\Controllers\MessageController;

 // 🏠 Public homepage
 Route::get('/', [HomeController::class, 'index'])->name('home');

 // 🔐 Auth routes
 require __DIR__ . '/auth.php';

 // 🔐 All authenticated users
 Route::middleware(['auth'])->group(function () {
     // 🧑 Profile routes
     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     // 👁️ All authenticated users can view individual posts
     Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

     // 📝 Feedback submission by any authenticated user
     Route::post('/posts/{post}/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
     Route::delete('/feedback/{feedback}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');

     // 💬 Chat
     Route::get('/chat', fn() => view('chat'))->name("user_chat");
     Route::post('/send-message', [MessageController::class, 'send']);
     Route::get('/messages', [MessageController::class, 'fetch']);
 });

 // 👀 Viewer-only access to read content
 Route::middleware(['auth', 'role:viewer'])->group(function () {
     Route::get('/read-posts', [PublicController::class, 'index'])->name('read-posts.index');
     Route::get('/read-posts/{post}', [PublicController::class, 'show'])->name('read-posts.show');
 });

 // 🧑‍💼 Admin + Author access (🚫 Viewers blocked)
 Route::middleware(['auth', 'redirect.viewer'])->group(function () {
     // 📊 Dashboard
     Route::get('/dashboard', DashboardController::class)->name('dashboard');
 });

 // 🧑‍💼 Admin + Author post management
 Route::middleware(['auth', 'role:admin,author'])->group(function () {
     // 📝 Post CRUD
     Route::resource('posts', PostController::class)->except(['show', 'create', 'edit']);
     Route::get('/posts/create', PostForm::class)->name('posts.create');
     Route::get('/posts/{postId}/edit', PostForm::class)->name('posts.edit');

     // 📥 Feedback inbox
     Route::resource('feedback', FeedbackController::class)->only(['index', 'show', 'destroy']);
 });

 // 🧑‍⚖️ Admin-only routes
 Route::middleware(['auth', 'role:admin'])->group(function () {
     // 🗂 Categories (except index)
     Route::resource('categories', CategoryController::class)->except(['index']);

     // 👥 User management
     Route::prefix('admin')->name('admin.')->group(function () {
         Route::get('/users', [UserController::class, 'index'])->name('users.index');
         Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('users.assignRole');
     });
 });

 // 📂 Categories index viewable by all authenticated users
 Route::middleware('auth')->get('/categories', [CategoryController::class, 'index'])->name('categories.index');
