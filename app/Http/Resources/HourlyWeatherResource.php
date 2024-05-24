<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HourlyWeatherResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
          'temp_c' => $this->temp_c,
          'temp_f' => $this->temp_f,
          'condition' => $this->condition,
          'wind_mph' => $this->wind_mph,
          'wind_kph' => $this->wind_kph,
          'wind_degree' => $this->wind_degree,
          'wind_dir' => $this->wind_dir,
          'pressure_mb' => $this->pressure_mb,
          'pressure_in' => $this->pressure_in,
          'cloud' => $this->cloud,
          'localtime' => $this->localtime,
        ];
    }
}
