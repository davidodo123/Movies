<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $inception = Movie::where('title', 'Inception')->first();
        $isle      = Movie::where('title', 'Isle of Dogs')->first();

        Review::create([
            'movie_id' => $inception->id,
            'author'   => 'Alice',
            'text'     => 'Mind-blowing and clever.',
            'rating'   => 5,
        ]);

        Review::create([
            'movie_id' => $isle->id,
            'author'   => 'Bob',
            'text'     => 'Visualmente preciosa y muy original.',
            'rating'   => 4,
        ]);
    }
}
