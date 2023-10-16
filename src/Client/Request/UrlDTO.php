<?php

namespace Pow10s\Softswiss\Client\Request;

use Pow10s\Softswiss\Client\DTO;

final readonly class UrlDTO extends DTO
{
    public function __construct(
        public ?string $return_url,
        public ?string $deposit_url = null,
    )
    {}
}
