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
        Schema::table('questions', function (Blueprint $table) {
            $table->unsignedTinyInteger('year')->nullable();
            $table->string('theme')->nullable();
            $table->string('lesson')->nullable();
            $table->string('google_query')->nullable();
            $table->unsignedTinyInteger('answer_count')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('year');
            $table->dropColumn('theme');
            $table->dropColumn('lesson');
            $table->dropColumn('google_query');
            $table->dropColumn('answer_count');
        });
    }
};
