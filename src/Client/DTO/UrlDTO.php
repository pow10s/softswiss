<?php

namespace Pow10s\Softswiss\DTO;

readonly class UrlDTO
{
    public function __construct(
        public ?string $return_url,
        public ?string $deposit_url = null,
    )
    {}
}
