<?php
 use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\Api\AuthController;
 use App\Http\Controllers\Api\PostController;
 use App\Http\Controllers\Api\CategoryController;
 use App\Http\Controllers\Api\FeedbackController;
 use App\Http\Controllers\ProfileController;
 use App\Http\Controllers\UserController;
 use App\Http\Controllers\Api\MessageController;

 // 🟢 Public Routes
 Route::post('/login', [AuthController::class, 'login']);
 Route::post('/register', [AuthController::class, 'register']);

 // 🔐 Protected Routes (JWT Token Required)
 Route::middleware('auth:api')->group(function () {

     Route::get('/me', fn () => auth()->user());
     Route::post('/logout', [AuthController::class, 'logout']);

     // 📬 Messages
     Route::get('/messages', [MessageController::class, 'fetch']);
     Route::post('/send-message', [MessageController::class, 'send']);

     // 📝 Feedback
     Route::apiResource('feedback', FeedbackController::class)->only(['store', 'destroy', 'index', 'show']);

     // 👤 Profile
     Route::get('/profile', [ProfileController::class, 'edit']);
     Route::put('/profile', [ProfileController::class, 'update']);
     Route::delete('/profile', [ProfileController::class, 'destroy']);

     // 🧑‍💼 Post Management
     Route::middleware('role:admin,author')->group(function () {
         Route::apiResource('posts', PostController::class)->except(['create', 'edit']);
     });

     // 📂 View categories (any authenticated user)
     Route::get('/categories', [CategoryController::class, 'index']);

     // 🛡 Admin-only
     Route::middleware('role:admin')->group(function () {
         Route::apiResource('categories', CategoryController::class)->except(['index']);

         Route::prefix('admin')->group(function () {
             Route::get('/users', [UserController::class, 'index']);
             Route::post('/users/{user}/roles', [UserController::class, 'assignRole']);
         });
     });
 });
