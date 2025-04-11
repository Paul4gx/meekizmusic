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
        Schema::table('beats', function (Blueprint $table) {
            $table->string('color_accent')->nullable()->after('cover_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beats', function (Blueprint $table) {
            $table->dropColumn('color_accent');
        });
    }
}; 