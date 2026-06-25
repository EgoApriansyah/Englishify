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
        Schema::create('practice_videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('youtube_id');
            $table->string('category');
            $table->string('difficulty');
            $table->string('duration');
            $table->text('description')->nullable();
            $table->json('transcript_data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practice_videos');
    }
};
