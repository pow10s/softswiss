<?php

namespace Pow10s\Softswiss\Helpers;

class Hash
{
    public static function hmacSha256(array $data, string $key): string
    {
        $flags = JSON_THROW_ON_ERROR;

        return hash_hmac('sha256', json_encode($data, $flags), $key);
    }
}
