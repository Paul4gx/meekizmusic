<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run()
    {
        $genres = [
            [
                'name' => 'Hip Hop',
                'description' => 'A genre of music developed in the United States by inner-city African Americans and Latino Americans in the Bronx borough of New York City in the 1970s.'
            ],
            [
                'name' => 'R&B',
                'description' => 'A genre of popular music that originated in African-American communities in the 1940s.'
            ],
            [
                'name' => 'Trap',
                'description' => 'A subgenre of hip hop music that originated in the Southern United States during the early 2000s.'
            ],
            [
                'name' => 'Afrobeat',
                'description' => 'A Nigerian music genre that involves the combination of West African musical styles such as fuji music and highlife with American funk and jazz influences.'
            ],
            [
                'name' => 'Pop',
                'description' => 'A genre of popular music that originated in its modern form during the mid-1950s in the United States and the United Kingdom.'
            ],
            [
                'name' => 'Electronic',
                'description' => 'A broad range of percussive electronic music genres made largely for nightclubs, raves, and festivals.'
            ],
            [
                'name' => 'Rock',
                'description' => 'A broad genre of popular music that originated as "rock and roll" in the United States in the late 1940s and early 1950s.'
            ],
            [
                'name' => 'Jazz',
                'description' => 'A music genre that originated in the African-American communities of New Orleans, Louisiana, in the late 19th and early 20th centuries.'
            ]
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
} 