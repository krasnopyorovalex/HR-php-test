<?php

declare(strict_types=1);

namespace App\Domain\Weather;

class WeatherParser
{
    /**
     * @param string $result
     * @return int
     */
    public function getTemperature(string $result): int
    {
        $formattedResult = json_decode($result, true);

        return (int) $formattedResult['fact']['temp'];
    }
}
