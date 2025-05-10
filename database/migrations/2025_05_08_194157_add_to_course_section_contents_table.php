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
        Schema::table('course_section_contents', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->string('extension')->nullable();
            $table->float ('file_size')->nullable();
            $table->float('file_duration')->nullable();
            $table->enum('type', ['video', 'file', 'article'])->default('video');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_section_contents', function (Blueprint $table) {
            //
        });
    }
};
