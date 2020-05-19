<?php

declare(strict_types=1);

namespace Domain\Weather;

use App\Domain\Weather\WeatherParser;
use Domain\Weather\Client\WeatherClient;

class WeatherService
{
    /**
     * @var WeatherClient
     */
    private $weatherClient;
    /**
     * @var WeatherParser
     */
    private $weatherParser;

    /**
     * WeatherService constructor.
     * @param WeatherClient $weatherClient
     * @param WeatherParser $weatherParser
     */
    public function __construct(WeatherClient $weatherClient, WeatherParser $weatherParser)
    {
        $this->weatherClient = $weatherClient;
        $this->weatherParser = $weatherParser;
    }

    /**
     * @param float $lat
     * @param float $lon
     * @return int
     */
    public function getWeatherForCity(float $lat, float $lon): int
    {
        $response = $this->weatherClient->get($lat, $lon);

        return $this->weatherParser->getTemperature($response);
    }
}
