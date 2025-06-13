<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            [
                'name'  => 'admin',
                'label' => 'Administrator',
            ],
            [
                'name'  => 'author',
                'label' => 'Content Author',
            ],
            [
                'name'  => 'viewer',
                'label' => 'Read-Only User',
            ],
        ]);
    }
}
