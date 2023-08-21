<?php

namespace Pow10s\Softswiss\DTO;

readonly class UserDTO
{
    public function __construct(
        public ?string $id,
        public ?string $nickname,
        public ?string $email,
        public ?string $registered_at,
        public ?string $country,
        public ?string $firstname,
        public ?string $lastname,
        public ?string $gender,
        public ?string $date_of_birth,
    ) {}
}
