<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('time_tracks', function (Blueprint $table) {
            $table->enum('status', ['draft', 'final'])->default('draft')->after('memo');
        });
    }

    public function down(): void
    {
        Schema::table('time_tracks', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
