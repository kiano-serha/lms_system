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
        Schema::table('course_questions', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->enum('type', ['scq', 'mcq'])->default('scq');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_questions', function (Blueprint $table) {
            //
        });
    }
};
