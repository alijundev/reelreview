<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $movies = [
            [
                'title'        => 'Inception',
                'synopsis'     => 'Seorang pencuri yang memiliki kemampuan untuk memasuki mimpi orang lain direkrut untuk menanamkan sebuah ide ke dalam pikiran seorang eksekutif bisnis.',
                'director'     => 'Christopher Nolan',
                'release_year' => 2010,
                'duration'     => 148,
                'genre'        => 'Science Fiction',
            ],
            [
                'title'        => 'The Dark Knight',
                'synopsis'     => 'Batman harus menghadapi ancaman dari Joker, seorang penjahat khaotik yang ingin menghancurkan Gotham City dengan menabur kekacauan.',
                'director'     => 'Christopher Nolan',
                'release_year' => 2008,
                'duration'     => 152,
                'genre'        => 'Action',
            ],
            [
                'title'        => 'Parasite',
                'synopsis'     => 'Sebuah keluarga miskin perlahan menyusup ke dalam kehidupan sebuah keluarga kaya dengan cara yang licik dan penuh kejutan.',
                'director'     => 'Bong Joon-ho',
                'release_year' => 2019,
                'duration'     => 132,
                'genre'        => 'Drama',
            ],
            [
                'title'        => 'Get Out',
                'synopsis'     => 'Seorang pria kulit hitam menemukan rahasia gelap ketika mengunjungi keluarga kekasihnya yang berkulit putih di pedesaan.',
                'director'     => 'Jordan Peele',
                'release_year' => 2017,
                'duration'     => 104,
                'genre'        => 'Horror',
            ],
            [
                'title'        => 'Interstellar',
                'synopsis'     => 'Sebuah tim penjelajah antariksa melakukan perjalanan melewati lubang cacing di luar angkasa untuk memastikan kelangsungan hidup umat manusia.',
                'director'     => 'Christopher Nolan',
                'release_year' => 2014,
                'duration'     => 169,
                'genre'        => 'Science Fiction',
            ],
            [
                'title'        => 'Spirited Away',
                'synopsis'     => 'Seorang gadis muda terjebak di dunia roh dan harus bekerja di pemandian milik penyihir untuk menyelamatkan orang tuanya.',
                'director'     => 'Hayao Miyazaki',
                'release_year' => 2001,
                'duration'     => 125,
                'genre'        => 'Animation',
            ],
            [
                'title'        => 'The Grand Budapest Hotel',
                'synopsis'     => 'Seorang penjaga hotel legendaris dan sahabat mudanya terlibat dalam petualangan komik yang melibatkan pencurian lukisan dan persaingan dalam keluarga kaya.',
                'director'     => 'Wes Anderson',
                'release_year' => 2014,
                'duration'     => 99,
                'genre'        => 'Comedy',
            ],
            [
                'title'        => 'Your Name',
                'synopsis'     => 'Dua remaja yang tinggal di kota dan pedesaan secara misterius bertukar tubuh dan harus saling menemukan satu sama lain.',
                'director'     => 'Makoto Shinkai',
                'release_year' => 2016,
                'duration'     => 112,
                'genre'        => 'Romance',
            ],
            [
                'title'        => 'Joker',
                'synopsis'     => 'Seorang komedian gagal di Gotham City perlahan berubah menjadi kriminal berbahaya yang dikenal sebagai Joker.',
                'director'     => 'Todd Phillips',
                'release_year' => 2019,
                'duration'     => 122,
                'genre'        => 'Thriller',
            ],
            [
                'title'        => 'The Lord of the Rings: The Fellowship of the Ring',
                'synopsis'     => 'Seorang hobbit muda memulai perjalanan epik bersama sekelompok pahlawan untuk menghancurkan cincin berbahaya sebelum jatuh ke tangan kejahatan.',
                'director'     => 'Peter Jackson',
                'release_year' => 2001,
                'duration'     => 178,
                'genre'        => 'Fantasy',
            ],
        ];

        foreach ($movies as $data) {
            $genre = Genre::where('name', $data['genre'])->first();
            if ($genre) {
                Movie::firstOrCreate(
                    ['title' => $data['title']],
                    [
                        'synopsis'     => $data['synopsis'],
                        'director'     => $data['director'],
                        'release_year' => $data['release_year'],
                        'duration'     => $data['duration'],
                        'genre_id'     => $genre->id,
                    ]
                );
            }
        }
    }
}
