<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class HourlyWeatherInformationByCity extends Model
{
    use HasFactory;

    protected $table = 'hourly_weather_information_by_city';
    protected $fillable = [
        'temp_c', 'temp_f', 'condition', 'wind_mph', 'wind_kph', 'localtime',
        'wind_degree', 'wind_dir', 'pressure_mb', 'pressure_in', 'cloud'
    ];

    protected $casts = [
        'condition' => 'json'
    ];

    public function cities(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function scopeByDay(Builder $query, Carbon $date):  Builder
    {
        return $query->whereDay('created_at', '=', $date);
    }

    public function scopeWhereCity(Builder $query, int $cityId):  Builder
    {
        return $query->where('city_id', $cityId);
    }
}
