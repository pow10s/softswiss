<?php

declare(strict_types=1);

namespace Pow10s\Softswiss\Client\Request;

use Pow10s\Softswiss\Client\DTO;

final readonly class RoundDetailsRequestDTO extends DTO
{
    public function __construct(
        public string $roundId,
        public ?string $roundType = null,
        public ?string $provider = null
    ) {
    }
}
