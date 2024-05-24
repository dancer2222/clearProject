<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';
    protected $fillable = ['name', 'region', 'country', 'lat', 'lon'];

    public function scopeWhereName(Builder $query, string $name): Builder
    {
        return $query->where('name', $name);
    }
    public function hourlyTemperature(): HasMany
    {
        return $this->hasMany(HourlyWeatherInformationByCity::class, 'city_id', 'id');
    }
}
