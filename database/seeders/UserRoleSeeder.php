<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'ashu7556@example.com')->first(); // update email
        $author = User::where('email', 'author@example.com')->first(); // update email

        $adminRole = Role::where('name', 'Admin')->first();
        $authorRole = Role::where('name', 'Author')->first();

        if ($admin && $adminRole) {
            $admin->roles()->sync([$adminRole->id]);
        }

        if ($author && $authorRole) {
            $author->roles()->sync([$authorRole->id]);
        }
    }
}
