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
        Schema::create('post_en', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('posts_id');
 
            $table->foreign('posts_id')->references('id')->on('posts');
            $table->string('title');
            $table->string('thumbnail');
            $table->text('content');
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
        //
    }
};
