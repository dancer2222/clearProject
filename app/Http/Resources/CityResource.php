<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class CityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
          'name' => $this->name,
          'region' => $this->region,
          'country' => $this->country,
          'lat' => $this->lat,
          'lon' =>$this ->lon,
          'allTemperature' => HourlyWeatherResource::collection($this->whenLoaded('hourlyTemperature'))
        ];
    }
}
