<?php

namespace App\Providers;

use App\Domain\Weather\WeatherParser;
use Domain\Weather\Client\YandexWeatherClient;
use Domain\Weather\WeatherService;
use Illuminate\Support\ServiceProvider;

class WeatherProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(WeatherService::class, static function () {
            return new WeatherService(
                new YandexWeatherClient(config('weather.api_key')),
                new WeatherParser()
            );
        });
    }
}
