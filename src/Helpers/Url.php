<?php

namespace Pow10s\Softswiss\Helpers;

class Url
{
    public static function format(string $url, string $endpoint): string
    {
        return sprintf(
            '%s/%s',
            rtrim($url, '/'),
            ltrim($endpoint, '/')
        );
    }
}
