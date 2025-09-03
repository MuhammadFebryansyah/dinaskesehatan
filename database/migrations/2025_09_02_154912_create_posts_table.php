<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_posts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->json('meta_keywords')->nullable(); // Store as JSON array
            
            // Relations
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Author
            
            // Status & Settings
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->boolean('allow_comments')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('views_count')->default(0);
            
            // Publishing
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['status', 'published_at']);
            $table->index(['category_id', 'status']);
            $table->index(['is_featured', 'status']);
            $table->index('views_count');
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
};