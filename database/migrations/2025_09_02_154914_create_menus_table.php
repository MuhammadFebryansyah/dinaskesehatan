<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_menus_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('url')->nullable(); // Can be route name or external URL
            $table->string('route_name')->nullable(); // Laravel route name
            $table->json('route_params')->nullable(); // Route parameters
            
            // Menu structure
            $table->foreignId('parent_id')->nullable()->constrained('menus')->onDelete('cascade');
            $table->integer('sort_order')->default(0);
            $table->integer('level')->default(0); // For nested depth
            
            // Display settings
            $table->string('icon')->nullable(); // Font Awesome class
            $table->string('badge_text')->nullable(); // Like "New", "Hot", etc
            $table->string('badge_color')->default('primary');
            $table->string('target')->default('_self'); // _self, _blank
            
            // Permissions & Visibility
            $table->json('permissions')->nullable(); // Required permissions
            $table->json('roles')->nullable(); // Required roles
            $table->boolean('is_active')->default(true);
            $table->boolean('show_in_menu')->default(true);
            
            // Menu location
            $table->enum('location', ['header', 'footer', 'sidebar', 'admin'])->default('header');
            
            $table->timestamps();
            
            $table->index(['location', 'is_active', 'sort_order']);
            $table->index(['parent_id', 'sort_order']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
};