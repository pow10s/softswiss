<?php

namespace Pow10s\Softswiss\Client\Request;

final readonly class UserDTO
{
    public function __construct(
        public ?string $id,
        public ?string $nickname,
        public ?string $registered_at,
        public ?string $country,
        public ?string $firstname,
        public ?string $lastname,
        public ?string $gender,
        public ?string $date_of_birth,
        public ?string $external_id = null,
        public ?string $email = null,
    ) {}
}
