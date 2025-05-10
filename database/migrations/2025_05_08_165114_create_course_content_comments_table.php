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
        Schema::create('course_content_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_content_id');
            $table->foreignId('user_id');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('course_content_id')->references('id')->on('course_section_contents');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_content_comments');
    }
};
