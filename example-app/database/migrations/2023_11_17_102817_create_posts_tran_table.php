<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts_tran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
 
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('title');
            $table->string('thumbnail');
            $table->text('content');
            $table->tinyInteger('banner')->default(0); 
            $table->tinyInteger('status')->default(0); 
            $table->timestamp('public_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts_tran');
    }
};
