<?php

namespace App\RestAPI\WeatherAPI\Services;

use App\RestAPI\WeatherAPI\WeatherAPIClient;
use App\RestAPI\WeatherAPI\WeatherAPIInterface;

abstract class AbstractWeatherAPI implements WeatherAPIInterface
{
    public function __construct(private readonly WeatherAPIClient $client)
    {
    }

    public function get(string $uri): array
    {
        return $this->client->get($uri);
    }

    public function post(string $uri, array $data): array
    {
        return $this->client->post($uri, $data);
    }

    public function put(string $uri, array $data): array
    {
        return $this->client->put($uri, $data);
    }

    public function patch(string $uri, array $data): array
    {
        return $this->client->patch($uri, $data);
    }

    public function delete(string $uri, array $data): array
    {
        return $this->client->delete($uri, $data);
    }
}
