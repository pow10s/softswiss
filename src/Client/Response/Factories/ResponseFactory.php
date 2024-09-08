<?php

declare(strict_types=1);

namespace Pow10s\Softswiss\Client\Response\Factories;

use Pow10s\Softswiss\Client\Response\RoundDetailsResponseDTO;

class ResponseFactory
{
    public function fromRoundDetailsResponse(array $response): RoundDetailsResponseDTO
    {
        return new RoundDetailsResponseDTO(
            casinoIdentifier: $response['casino_identifier'] ?? null,
            providerIdentifier: $response['provider_identifier'] ?? null,
            userId: $response['user_id'] ?? null,
            finished: $response['finished'] ?? false,
        );
    }
}
