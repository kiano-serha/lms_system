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
        Schema::create('course_section_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id');
            $table->foreignId('course_section_id');
            $table->string('title');
            $table->string('file');
            $table->text('description');
            $table->integer('type');
            $table->integer('completed');
            $table->foreign('course_id')->references('id')->on('courses')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('course_section_id')->references('id')->on('course_sections')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_section_contents');
    }
};
