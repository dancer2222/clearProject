<?php

namespace App\RestAPI\WeatherAPI;

use App\RestAPI\Enums\HttpMethod;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ClientException;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use JetBrains\PhpStorm\NoReturn;

class WeatherAPIClient
{
    public function __construct(private readonly Client $client)
    {
    }

    public function get(string $uri): array
    {
        return $this->request(HttpMethod::GET, $uri);
    }

    public function post(string $uri, array $data): array
    {
        return $this->request(HttpMethod::POST, $uri, $data);
    }

    public function put(string $uri, array $data): array
    {
        return $this->request(HttpMethod::PUT, $uri, $data);
    }

    public function patch(string $uri, array $data): array
    {
        return $this->request(HttpMethod::PATCH, $uri, $data);
    }

    public function delete(string $uri, array $data): array
    {
        return $this->request(HttpMethod::DELETE, $uri, $data);
    }

    public function request(HttpMethod $method, string $uri, array $data = []): array
    {
        try {
            $response = $this->client->{$method->value}($this->getEndpoint($uri), [
                'headers' => $this->getHeaders(),
                'body' => json_encode($data),
            ]);

            return json_decode($response->getBody()->getContents(), true) ?? [];
        }  catch (ClientException $exception) {
            return json_decode($exception->getResponse()->getBody()->getContents(), true) ?? [];
        } catch (ConnectException|GuzzleException $exception) {
            Log::warning($exception->getMessage());

            throw ValidationException::withMessages(['messages' => $this->fixExceptionMessage($exception)]);
        }
    }

    private function getEndpoint(string $uri): string
    {
        return sprintf('%s%s', config('constants.weather_api_url'), $uri);
    }

    private function getHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
        ];
    }

    private function fixExceptionMessage(Exception $e): ?string
    {
        return match ($e->getCode()) {
            401 => 'Error with Fin System token',
            404 => 'Fin System endpoint not found',
            500 => 'Server error in Fin System',
            default => 'Something went wrong with Fin System',
        };
    }
}
