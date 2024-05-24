<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeatherRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'date' => ['date_format:Y-m-d']
        ];
    }
}
