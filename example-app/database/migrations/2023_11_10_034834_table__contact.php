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
        Schema::create('table_Contact', function (Blueprint $table) {
            $table->id(); // ID tự động tăng
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('title');
            $table->string('content');
            $table->timestamps(); // Thêm cột created_at và updated_at
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
