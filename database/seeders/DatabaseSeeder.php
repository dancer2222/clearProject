<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\HourlyWeatherInformationByCity;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
         City::factory(10)->create();
         HourlyWeatherInformationByCity::factory(10)->create();
    }
}
