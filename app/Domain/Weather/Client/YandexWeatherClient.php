<?php

declare(strict_types=1);

namespace Domain\Weather\Client;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class YandexWeatherClient implements WeatherClient
{
    /**
     * @var string
     */
    private $apiKey;

    private const BASE_URL = 'https://api.weather.yandex.ru';

    /**
     * YandexWeatherClient constructor.
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param float $lat
     * @param float $lon
     * @return ResponseInterface|string
     */
    public function get(float $lat, float $lon)
    {
        $httpClient = new Client([
            'base_uri' => self::BASE_URL
        ]);

        $headers = ['X-Yandex-API-Key' => $this->apiKey];

        $response = $httpClient->get("/v1/forecast?lat={$lat}&lon={$lon}", ['headers' => $headers]);

        if (! $response) {
            throw new BadRequestHttpException();
        }

        return $response->getBody()->getContents();
    }
}
