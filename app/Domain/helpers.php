<?php

if (! function_exists('format_as_price')) {
    function format_as_price(int $total): string {
        return sprintf('%s', number_format($total, 0, '.', ' '));
    }
}

if (! function_exists('format_temperature')) {
    function format_temperature(int $temperature): string {
        $prefixes = [-1 => '', 0 => '', 1 => '+'];
        return sprintf('%s %s °C', $prefixes[$temperature <=> 0], $temperature);
    }
}
