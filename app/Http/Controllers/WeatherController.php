<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Domain\Weather\WeatherService;

class WeatherController extends Controller
{
    /**
     * @var WeatherService
     */
    private $weatherService;

    /**
     * WeatherController constructor.
     * @param WeatherService $weatherService
     */
    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function __invoke()
    {
        $temperatureForBryansk = $this->weatherService->getWeatherForCity(53.243562, 34.363407);

        return view('weather.index', [
            'temperature' => $temperatureForBryansk
        ]);
    }
}
