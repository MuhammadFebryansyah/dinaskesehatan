<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Berita Umum',
                'description' => 'Berita dan informasi umum',
                'color' => '#007bff',
                'icon' => 'fas fa-newspaper',
                'sort_order' => 1,
            ],
            [
                'name' => 'Pengumuman',
                'description' => 'Pengumuman resmi',
                'color' => '#28a745',
                'icon' => 'fas fa-bullhorn',
                'sort_order' => 2,
            ],
            [
                'name' => 'Kegiatan',
                'description' => 'Dokumentasi kegiatan',
                'color' => '#ffc107',
                'icon' => 'fas fa-calendar-alt',
                'sort_order' => 3,
            ],
            [
                'name' => 'Layanan',
                'description' => 'Informasi layanan',
                'color' => '#17a2b8',
                'icon' => 'fas fa-cogs',
                'sort_order' => 4,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}