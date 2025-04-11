<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('beats', function (Blueprint $table) {
            $table->integer('bpm')->nullable()->after('price');
            $table->string('duration')->nullable()->after('bpm');
            $table->boolean('is_featured')->default(false)->after('duration');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft')->after('is_featured');
        });
    }

    public function down()
    {
        Schema::table('beats', function (Blueprint $table) {
            $table->dropColumn(['bpm', 'duration', 'is_featured', 'status']);
        });
    }
}; 