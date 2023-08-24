<?php

namespace Pow10s\Softswiss\Client\Request;

final readonly class SessionInitRequest
{
    public function __construct(
        public mixed    $balance = null,
        public ?string  $client_type = null,
        public ?string  $currency = null,
        public ?string  $game = null,
        public ?string  $ip = null,
        public ?string  $locale = null,
        public ?UrlDTO  $urls = null,
        public ?UserDTO $user = null,
        public ?string  $casino_id = null,
        public ?string  $jurisdiction = null,
        public ?string  $payload = null
    ) { }
}
