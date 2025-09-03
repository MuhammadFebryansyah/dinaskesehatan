<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_downloads_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            
            // File details
            $table->string('file_name'); // Original filename
            $table->string('file_path'); // Storage path
            $table->string('file_type'); // MIME type
            $table->bigInteger('file_size'); // in bytes
            $table->string('file_extension');
            
            // Categorization
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Uploader
            
            // Settings
            $table->boolean('is_active')->default(true);
            $table->boolean('require_login')->default(false);
            $table->integer('download_count')->default(0);
            $table->integer('sort_order')->default(0);
            
            // Metadata
            $table->json('tags')->nullable(); // For search/filtering
            
            $table->timestamps();
            
            $table->index(['is_active', 'sort_order']);
            $table->index('download_count');
        });
    }

    public function down()
    {
        Schema::dropIfExists('downloads');
    }
};