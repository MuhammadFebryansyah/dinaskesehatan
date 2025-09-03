<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User Management
            'view users',
            'create users',
            'edit users',
            'delete users',
            
            // Role Management
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            
            // Post Management
            'view posts',
            'create posts',
            'edit posts',
            'delete posts',
            'publish posts',
            
            // Page Management
            'view pages',
            'create pages',
            'edit pages',
            'delete pages',
            
            // Category Management
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',
            
            // Comment Management
            'view comments',
            'approve comments',
            'delete comments',
            
            // Media Management
            'view media',
            'upload media',
            'delete media',
            
            // Download Management
            'view downloads',
            'create downloads',
            'edit downloads',
            'delete downloads',
            
            // Gallery Management
            'view galleries',
            'create galleries',
            'edit galleries',
            'delete galleries',
            
            // Menu Management
            'view menus',
            'create menus',
            'edit menus',
            'delete menus',
            
            // Setting Management
            'view settings',
            'edit settings',
            
            // Contact Management
            'view contacts',
            'reply contacts',
            'delete contacts',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $superadmin = Role::create(['name' => 'superadmin']);
        $superadmin->givePermissionTo(Permission::all());

        $editor = Role::create(['name' => 'editor']);
        $editor->givePermissionTo([
            'view posts', 'create posts', 'edit posts',
            'view pages', 'create pages', 'edit pages',
            'view categories',
            'view comments', 'approve comments',
            'view media', 'upload media',
            'view downloads', 'create downloads', 'edit downloads',
            'view galleries', 'create galleries', 'edit galleries',
            'view contacts', 'reply contacts',
        ]);
    }
}
