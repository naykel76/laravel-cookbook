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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->longText('body')->nullable();
            $table->string('image')->nullable();
            $table->string('image_filepond')->nullable();
            $table->string('status');
            $table->boolean('is_free')->nullable();
            $table->integer('price')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->dateTime('reviewed_at')->nullable();
            $table->json('extra_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
