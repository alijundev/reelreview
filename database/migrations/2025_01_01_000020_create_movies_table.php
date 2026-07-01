<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('synopsis');
            $table->string('director');
            $table->year('release_year');
            $table->integer('duration'); // dalam menit
            $table->string('poster')->nullable(); // path poster opsional
            $table->foreignId('genre_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
