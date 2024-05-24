<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HourlyWeatherInformationByCity extends Model
{
    protected $table = 'hourly_weather_information_by_city';
    protected $fillable = [
        'temp_c', 'temp_f', 'condition', 'wind_mph', 'wind_kph', 'localtime',
        'wind_degree', 'wind_dir', 'pressure_mb', 'pressure_in', 'cloud'
    ];

    protected $casts = [
        'condition' => 'json',
//        'localtime' => 'date'
    ];

    public function cities(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
