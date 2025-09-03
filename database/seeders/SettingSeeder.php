<?php
// database/seeders/SettingSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            // Site Information
            [
                'key' => 'site_name',
                'value' => 'Website Kantor',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Nama Website',
                'description' => 'Nama website yang akan ditampilkan',
                'is_public' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'site_description',
                'value' => 'Website resmi kantor dengan informasi terkini',
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'Deskripsi Website',
                'description' => 'Deskripsi singkat tentang website',
                'is_public' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'site_logo',
                'value' => '',
                'type' => 'file',
                'group' => 'general',
                'label' => 'Logo Website',
                'description' => 'Logo yang akan ditampilkan di header',
                'is_public' => true,
                'sort_order' => 3,
            ],
            [
                'key' => 'site_favicon',
                'value' => '',
                'type' => 'file',
                'group' => 'general',
                'label' => 'Favicon',
                'description' => 'Icon kecil yang muncul di tab browser',
                'is_public' => true,
                'sort_order' => 4,
            ],
            
            // Contact Information
            [
                'key' => 'contact_address',
                'value' => 'Jl. Contoh No. 123, Kota, Provinsi',
                'type' => 'textarea',
                'group' => 'contact',
                'label' => 'Alamat',
                'description' => 'Alamat lengkap kantor',
                'is_public' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'contact_phone',
                'value' => '+62 21 1234567',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Nomor Telepon',
                'description' => 'Nomor telepon utama',
                'is_public' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'contact_email',
                'value' => 'info@kantor.com',
                'type' => 'email',
                'group' => 'contact',
                'label' => 'Email',
                'description' => 'Alamat email utama',
                'is_public' => true,
                'sort_order' => 3,
            ],
            [
                'key' => 'contact_whatsapp',
                'value' => '+6281234567890',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'WhatsApp',
                'description' => 'Nomor WhatsApp untuk kontak cepat',
                'is_public' => true,
                'sort_order' => 4,
            ],
            
            // Social Media
            [
                'key' => 'social_facebook',
                'value' => '',
                'type' => 'url',
                'group' => 'social',
                'label' => 'Facebook',
                'description' => 'Link halaman Facebook',
                'is_public' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'social_instagram',
                'value' => '',
                'type' => 'url',
                'group' => 'social',
                'label' => 'Instagram',
                'description' => 'Link halaman Instagram',
                'is_public' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'social_twitter',
                'value' => '',
                'type' => 'url',
                'group' => 'social',
                'label' => 'Twitter',
                'description' => 'Link halaman Twitter',
                'is_public' => true,
                'sort_order' => 3,
            ],
            [
                'key' => 'social_youtube',
                'value' => '',
                'type' => 'url',
                'group' => 'social',
                'label' => 'YouTube',
                'description' => 'Link channel YouTube',
                'is_public' => true,
                'sort_order' => 4,
            ],
            
            // SEO Settings
            [
                'key' => 'seo_title',
                'value' => 'Website Kantor - Informasi Terkini',
                'type' => 'text',
                'group' => 'seo',
                'label' => 'Meta Title',
                'description' => 'Title tag untuk SEO',
                'is_public' => true,
                'sort_order' => 1,
            ],
            [
                'key' => 'seo_description',
                'value' => 'Website resmi kantor dengan informasi layanan dan berita terkini',
                'type' => 'textarea',
                'group' => 'seo',
                'label' => 'Meta Description',
                'description' => 'Deskripsi untuk search engine',
                'is_public' => true,
                'sort_order' => 2,
            ],
            [
                'key' => 'seo_keywords',
                'value' => 'kantor, layanan, berita, informasi',
                'type' => 'text',
                'group' => 'seo',
                'label' => 'Meta Keywords',
                'description' => 'Kata kunci dipisah koma',
                'is_public' => true,
                'sort_order' => 3,
            ],
            
            // System Settings
            [
                'key' => 'posts_per_page',
                'value' => '10',
                'type' => 'number',
                'group' => 'system',
                'label' => 'Post Per Halaman',
                'description' => 'Jumlah post yang ditampilkan per halaman',
                'is_public' => false,
                'sort_order' => 1,
            ],
            [
                'key' => 'comments_auto_approve',
                'value' => 'false',
                'type' => 'boolean',
                'group' => 'system',
                'label' => 'Auto Approve Komentar',
                'description' => 'Otomatis menyetujui komentar baru',
                'is_public' => false,
                'sort_order' => 2,
            ],
            [
                'key' => 'maintenance_mode',
                'value' => 'false',
                'type' => 'boolean',
                'group' => 'system',
                'label' => 'Mode Maintenance',
                'description' => 'Aktifkan mode maintenance',
                'is_public' => false,
                'sort_order' => 3,
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
