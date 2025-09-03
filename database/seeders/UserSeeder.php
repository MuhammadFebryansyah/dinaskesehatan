<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create Super Admin
        $superadmin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@kantor.com',
            'password' => 'password',
            'is_active' => true,
        ]);
        $superadmin->assignRole('superadmin');

        // Create Editor
        $editor = User::create([
            'name' => 'Editor',
            'email' => 'editor@kantor.com',
            'password' => 'password',
            'is_active' => true,
        ]);
        $editor->assignRole('editor');
    }
}

