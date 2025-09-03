<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_contacts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            
            // Contact details
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('subject');
            $table->longText('message');
            
            // Additional info
            $table->string('company')->nullable();
            $table->string('website')->nullable();
            
            // System info
            $table->ipAddress('ip_address');
            $table->text('user_agent')->nullable();
            $table->string('referrer')->nullable();
            
            // Status & Management
            $table->enum('status', ['unread', 'read', 'replied', 'archived'])->default('unread');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->text('admin_notes')->nullable();
            $table->timestamp('replied_at')->nullable();
            
            // Anti-spam
            $table->boolean('is_spam')->default(false);
            $table->integer('spam_score')->default(0);
            
            $table->timestamps();
            
            $table->index(['status', 'created_at']);
            $table->index('email');
            $table->index('is_spam');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};