<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeatherRequest;
use App\Http\Resources\CityResource;
use App\Http\Resources\HourlyWeatherResource;
use App\Models\City;
use App\Models\HourlyWeatherInformationByCity;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Carbon;

class WeatherController extends Controller
{
    public function show(City $city): CityResource
    {
        return new CityResource($city->load('hourlyTemperature'));
    }

    public function showByDate(City $city, WeatherRequest $request): AnonymousResourceCollection
    {
        return HourlyWeatherResource::collection(
            HourlyWeatherInformationByCity::whereCity($city->id)
                ->byDay(Carbon::parse($request->date) ?? now())
                ->get()
        );
    }
}
