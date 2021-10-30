<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::query()->truncate();

        City::create(['name' => 'Cary']);
        City::create(['name' => 'Raleigh']);
        City::create(['name' => 'Durham']);
        City::create(['name' => 'Chapel Hill']);
    }
}
