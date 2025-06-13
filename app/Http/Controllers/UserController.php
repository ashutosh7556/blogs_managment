<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function assignRole($userId, $roleName)
    {
        $user = User::findOrFail($userId);
        $role = Role::where('name', $roleName)->firstOrFail();

        // Attach role
        $user->roles()->syncWithoutDetaching([$role->id]);

        return redirect()->back()->with('success', 'Role assigned successfully.');
    }
}
