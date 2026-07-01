<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Urutan penting: GenreSeeder harus jalan sebelum MovieSeeder
     * karena MovieSeeder membutuhkan genre_id.
     */
    public function run(): void
    {
        $this->call([
            GenreSeeder::class,
            AdminSeeder::class,
            MovieSeeder::class,
        ]);
    }
}
