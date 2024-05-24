<?php

namespace App\RestAPI\WeatherAPI\Services;

class WeatherAPIService extends AbstractWeatherAPI
{
    public function getWeatherInfoByCity(string $city): array
    {
        return $this->get(
            sprintf('?key=%s&q=%s&aqi=%s',
                config('constants.weather_api_key'),
                $city,
                'no'
            ));
    }


}
