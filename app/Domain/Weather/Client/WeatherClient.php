<?php

declare(strict_types=1);

namespace Domain\Weather\Client;

interface WeatherClient
{
    public function get(float $lat, float $lon);
}
