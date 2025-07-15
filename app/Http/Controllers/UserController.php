<?php

 namespace App\Http\Controllers;

 use App\Models\User;
 use App\Models\Role; // 👈 Use your custom Role model
 use Illuminate\Http\Request;

 class UserController extends Controller
 {
     public function index()
     {
         $users = User::with('roles')->get();

         // ✅ This now correctly counts users per role
         $roles = Role::withCount('users')->get();

         return view('users.index', compact('users', 'roles'));
     }

     public function assignRole(Request $request, $userId)
     {
         $request->validate([
             'roleName' => 'required|string|exists:roles,name',
         ]);

         $user = User::findOrFail($userId);

         if ($user->hasRole('admin')) {
             return redirect()->back()->with('error', 'You cannot change the role of an admin user.');
         }

         if ($request->roleName === 'admin') {
             return redirect()->back()->with('error', 'You cannot assign the admin role.');
         }

         $user->syncRoles([$request->roleName]);

         return redirect()->back()->with('success', 'Role assigned successfully.');
     }
 }
