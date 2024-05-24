<?php

namespace App\RestAPI\WeatherAPI;

interface WeatherAPIInterface
{
    public function getWeatherInfoByCity(string $city);
}
