<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\HourlyWeatherInformationByCity;
use App\RestAPI\WeatherAPI\Services\WeatherAPIService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class GetTemperatureByCity extends Command
{
    protected $signature = 'temperature:by_city {city_name? : default - Kyiv}';
    protected $description = 'Get Temperature By City';

    private const DEFAULT_CITY_NAME = 'Kyiv';
    private string $city_name;

    public function __construct(private readonly WeatherAPIService $weatherAPIService)
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $this->setParameters();
        $this->handleWeatherData($this->weatherAPIService->getWeatherInfoByCity($this->city_name));
    }

    private function setParameters(): void
    {
        $this->city_name = $this->argument('city_name') ?: self::DEFAULT_CITY_NAME;
    }

    private function handleWeatherData(array $result): void
    {
        $city = City::whereName($result['location']['name'])->firstOr(
            function () use ($result){
                $city = new City();
                $city->fill($result['location']);
                $city->save();

                return $city;
            }
        );

        $this->handleWeatherByHoursInformation($city, $result);
     }

     private function handleWeatherByHoursInformation(City $city, array $result): void
     {
         $weatherInformation = new HourlyWeatherInformationByCity();
         $weatherInformation->fill($result['current']);
         $weatherInformation->localtime = Carbon::parse($result['location']['localtime']);
         $weatherInformation->condition = $result['current']['condition'];

         $city->hourlyTemperature()->create(
             $weatherInformation->toArray()
         );
     }
}
