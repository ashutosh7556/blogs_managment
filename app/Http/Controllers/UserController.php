<?php

 namespace App\Http\Controllers;

 use App\Models\User;
 use Illuminate\Http\Request;
 use Spatie\Permission\Models\Role;

 class UserController extends Controller
 {
     public function index()
     {
         $users = User::with('roles')->get(); // Fetch users with their roles
         $roles = Role::all(); // Fetch all roles

         return view('users.index', compact('users', 'roles'));
     }

     public function assignRole(Request $request, $userId)
     {
         $request->validate([
             'roleName' => 'required|string|exists:roles,name',
         ]);

         $user = User::findOrFail($userId);

         // Prevent changing role if the target user is an admin
         if ($user->hasRole('admin')) {
             return redirect()->back()->with('error', 'You cannot change the role of an admin user.');
         }

         // Optional: prevent assigning 'admin' role
         if ($request->roleName === 'admin') {
             return redirect()->back()->with('error', 'You cannot assign the admin role.');
         }

         $user->syncRoles([$request->roleName]);

         return redirect()->back()->with('success', 'Role assigned successfully.');
     }

 }
