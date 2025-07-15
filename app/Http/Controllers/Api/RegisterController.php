<?php

 namespace App\Http\Controllers\Api;

 use App\Http\Controllers\Controller;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Hash;
 use App\Models\User;

 class AuthController extends Controller
 {
     public function register(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|string|email|unique:users',
             'password' => 'required|string|min:8|confirmed',
         ]);

         $user = User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->password),
         ]);

         $token = $user->createToken('api-token')->plainTextToken;

         return response()->json([
             'message' => 'User registered successfully',
             'user' => $user,
             'token' => $token
         ]);
     }
 }
