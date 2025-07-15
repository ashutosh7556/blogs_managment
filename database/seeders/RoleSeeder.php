<?php

 namespace Database\Seeders;

 use Illuminate\Database\Seeder;
 use Spatie\Permission\Models\Role;

 class RoleSeeder extends Seeder
 {

public function run(): void
{
    Role::whereIn('name', ['admin', 'author', 'viewer'])->delete(); // 👈 safer

    Role::insert([
        [
            'name'       => 'admin',
            'label'      => 'Administrator',
            'guard_name' => 'web',
        ],
        [
            'name'       => 'author',
            'label'      => 'Content Author',
            'guard_name' => 'web',
        ],
        [
            'name'       => 'viewer',
            'label'      => 'Read-Only User',
            'guard_name' => 'web',
        ],
    ]);
}

 }
