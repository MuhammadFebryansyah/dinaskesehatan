<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // Header Menu
        $menus = [
            [
                'name' => 'Beranda',
                'slug' => 'beranda',
                'route_name' => 'home',
                'location' => 'header',
                'sort_order' => 1,
                'icon' => 'fas fa-home',
            ],
            [
                'name' => 'Profil',
                'slug' => 'profil',
                'route_name' => 'profil',
                'location' => 'header',
                'sort_order' => 2,
                'icon' => 'fas fa-info-circle',
            ],
            [
                'name' => 'Berita',
                'slug' => 'berita',
                'route_name' => 'posts.index',
                'location' => 'header',
                'sort_order' => 3,
                'icon' => 'fas fa-newspaper',
            ],
            [
                'name' => 'Galeri',
                'slug' => 'galeri',
                'route_name' => 'galleries.index',
                'location' => 'header',
                'sort_order' => 4,
                'icon' => 'fas fa-images',
            ],
            [
                'name' => 'Download',
                'slug' => 'download',
                'route_name' => 'downloads.index',
                'location' => 'header',
                'sort_order' => 5,
                'icon' => 'fas fa-download',
            ],
            [
                'name' => 'Kontak',
                'slug' => 'kontak',
                'route_name' => 'contact',
                'location' => 'header',
                'sort_order' => 6,
                'icon' => 'fas fa-envelope',
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }

        // Admin Menu
        $adminMenus = [
            [
                'name' => 'Dashboard',
                'slug' => 'admin-dashboard',
                'route_name' => 'admin.dashboard',
                'location' => 'admin',
                'sort_order' => 1,
                'icon' => 'fas fa-tachometer-alt',
            ],
            [
                'name' => 'Posts',
                'slug' => 'admin-posts',
                'route_name' => 'admin.posts.index',
                'location' => 'admin',
                'sort_order' => 2,
                'icon' => 'fas fa-newspaper',
                'permissions' => ['view posts'],
            ],
            [
                'name' => 'Pages',
                'slug' => 'admin-pages',
                'route_name' => 'admin.pages.index',
                'location' => 'admin',
                'sort_order' => 3,
                'icon' => 'fas fa-file-alt',
                'permissions' => ['view pages'],
            ],
            [
                'name' => 'Categories',
                'slug' => 'admin-categories',
                'route_name' => 'admin.categories.index',
                'location' => 'admin',
                'sort_order' => 4,
                'icon' => 'fas fa-tags',
                'permissions' => ['view categories'],
            ],
            [
                'name' => 'Media',
                'slug' => 'admin-media',
                'route_name' => 'admin.media.index',
                'location' => 'admin',
                'sort_order' => 5,
                'icon' => 'fas fa-photo-video',
                'permissions' => ['view media'],
            ],
            [
                'name' => 'Downloads',
                'slug' => 'admin-downloads',
                'route_name' => 'admin.downloads.index',
                'location' => 'admin',
                'sort_order' => 6,
                'icon' => 'fas fa-download',
                'permissions' => ['view downloads'],
            ],
            [
                'name' => 'Gallery',
                'slug' => 'admin-galleries',
                'route_name' => 'admin.galleries.index',
                'location' => 'admin',
                'sort_order' => 7,
                'icon' => 'fas fa-images',
                'permissions' => ['view galleries'],
            ],
            [
                'name' => 'Comments',
                'slug' => 'admin-comments',
                'route_name' => 'admin.comments.index',
                'location' => 'admin',
                'sort_order' => 8,
                'icon' => 'fas fa-comments',
                'permissions' => ['view comments'],
            ],
            [
                'name' => 'Contacts',
                'slug' => 'admin-contacts',
                'route_name' => 'admin.contacts.index',
                'location' => 'admin',
                'sort_order' => 9,
                'icon' => 'fas fa-envelope',
                'permissions' => ['view contacts'],
            ],
            [
                'name' => 'Users',
                'slug' => 'admin-users',
                'route_name' => 'admin.users.index',
                'location' => 'admin',
                'sort_order' => 10,
                'icon' => 'fas fa-users',
                'permissions' => ['view users'],
                'roles' => ['superadmin'],
            ],
            [
                'name' => 'Settings',
                'slug' => 'admin-settings',
                'route_name' => 'admin.settings.index',
                'location' => 'admin',
                'sort_order' => 11,
                'icon' => 'fas fa-cog',
                'permissions' => ['view settings'],
                'roles' => ['superadmin'],
            ],
        ];

        foreach ($adminMenus as $menu) {
            if (isset($menu['permissions'])) {
                $menu['permissions'] = json_encode($menu['permissions']);
            }
            if (isset($menu['roles'])) {
                $menu['roles'] = json_encode($menu['roles']);
            }
            Menu::create($menu);
        }
    }
}