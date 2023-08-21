<?php

namespace Pow10s\Softswiss\DTO;

readonly class SessionInitDTO
{
    public function __construct(
        public ?string  $casino_id = null,
        public mixed    $balance = null,
        public ?string  $client_type = null,
        public ?string  $currency = null,
        public ?string  $game = null,
        public ?string  $ip = null,
        public ?string  $locale = null,
        public ?UrlDTO  $urls = null,
        public ?UserDTO $user = null,
    ) { }
}
