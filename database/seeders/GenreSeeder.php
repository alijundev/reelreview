<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            'Action',
            'Comedy',
            'Drama',
            'Horror',
            'Romance',
            'Science Fiction',
            'Animation',
            'Documentary',
            'Thriller',
            'Fantasy',
        ];

        foreach ($genres as $genre) {
            Genre::firstOrCreate(['name' => $genre]);
        }
    }
}
