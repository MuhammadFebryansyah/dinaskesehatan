<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_pages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->json('meta_keywords')->nullable();
            
            // Template & Layout
            $table->string('template')->default('default'); // For different page layouts
            $table->json('custom_fields')->nullable(); // For flexible content
            
            // Relations
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Author
            
            // Status
            $table->enum('status', ['draft', 'published'])->default('published');
            $table->boolean('show_in_menu')->default(false);
            $table->integer('menu_order')->default(0);
            
            $table->timestamps();
            
            $table->index(['status', 'show_in_menu']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pages');
    }
};