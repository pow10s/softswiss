<?php

namespace Pow10s\Softswiss\Client;

readonly class DTO
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        $flags = JSON_THROW_ON_ERROR;

        return json_decode(
            json_encode($this, $flags), true, 512, $flags
        );
    }
}
