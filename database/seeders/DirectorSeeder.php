<?php

namespace Database\Seeders;

use App\Models\Director;
use Illuminate\Database\Seeder;

class DirectorSeeder extends Seeder
{
    public function run(): void
    {
        Director::create([
            'name'      => 'Christopher Nolan',
            'country'   => 'UK',
            'birthdate' => '1970-07-30',
        ]);

        Director::create([
            'name'      => 'Wes Anderson',
            'country'   => 'USA',
            'birthdate' => '1969-05-01',
        ]);
    }
}
