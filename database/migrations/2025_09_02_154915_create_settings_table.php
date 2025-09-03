<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_settings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // Setting identifier
            $table->longText('value')->nullable(); // Setting value (JSON, string, etc)
            $table->string('type')->default('text'); // text, textarea, select, boolean, file, etc
            $table->string('group')->default('general'); // Group settings together
            $table->string('label'); // Human readable label
            $table->text('description')->nullable(); // Help text
            $table->json('options')->nullable(); // For select/radio options
            $table->boolean('is_public')->default(false); // Can be accessed from frontend
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->index(['group', 'sort_order']);
            $table->index('is_public');
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
};