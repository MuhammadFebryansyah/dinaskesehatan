<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_galleries_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            
            // Image details
            $table->string('image_path');
            $table->string('thumbnail_path')->nullable();
            $table->string('alt_text')->nullable();
            $table->json('image_meta')->nullable(); // Store EXIF data, dimensions, etc
            
            // Categorization
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Uploader
            
            // Settings
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->integer('views_count')->default(0);
            
            // Metadata
            $table->json('tags')->nullable();
            $table->date('taken_at')->nullable(); // When photo was taken
            $table->string('photographer')->nullable();
            
            $table->timestamps();
            
            $table->index(['is_active', 'is_featured']);
            $table->index(['category_id', 'is_active']);
            $table->index('sort_order');
        });
    }

    public function down()
    {
        Schema::dropIfExists('galleries');
    }
};