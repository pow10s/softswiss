<?php

declare(strict_types=1);

namespace Pow10s\Softswiss\Client\Response;

use Pow10s\Softswiss\Client\DTO;

final readonly class RoundDetailsResponseDTO extends DTO
{
    public function __construct(
        public ?string $casinoIdentifier,
        public ?string $providerIdentifier,
        public ?string $userId,
        public bool $finished,
    ) {
    }

    public function isFinished(): bool
    {
        return $this->finished;
    }
}
