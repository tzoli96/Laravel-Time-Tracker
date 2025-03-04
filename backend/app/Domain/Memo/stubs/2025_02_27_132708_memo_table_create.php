<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Memo\Enums\TimeTrackStatus;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('time_tracks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->timestamp('start');
            $table->timestamp('finish')->nullable();
            $table->integer('duration')->nullable();
            $table->text('memo')->nullable();
            $table->enum('status', [TimeTrackStatus::DRAFT->value, TimeTrackStatus::FINAL->value])
                ->default(TimeTrackStatus::DRAFT->value)
                ->after('memo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('time_tracks');
    }
};
