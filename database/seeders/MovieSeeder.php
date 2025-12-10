<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Director;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $nolan = Director::where('name', 'Christopher Nolan')->first();
        $wes   = Director::where('name', 'Wes Anderson')->first();

        Movie::create([
            'title'       => 'Inception',
            'synopsis'    => 'A thief who steals corporate secrets through dream-sharing technology...',
            'year'        => 2010,
            'director_id' => $nolan->id,
            'path'        => null,
        ]);

        Movie::create([
            'title'       => 'Isle of Dogs',
            'synopsis'    => 'In a dystopian future Japan, dogs have been quarantined on a remote island...',
            'year'        => 2018,
            'director_id' => $wes->id,
            'path'        => null,
        ]);
    }
}
