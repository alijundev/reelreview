<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('movie_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger('rating'); // 1-10
            $table->text('review_text');
            $table->boolean('is_spoiler')->default(false);
            $table->timestamps();
            // 1 user hanya boleh 1 review per film
            $table->unique(['user_id', 'movie_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
