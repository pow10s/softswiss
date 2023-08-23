<?php

namespace Pow10s\Softswiss\Client\Response\DTO;

use Carbon\Carbon;

final readonly class GameDTO
{
    public function __construct(
        string $title,
        string $identifier,
        string $provider,
        string $category,
        string $feature_group,
        array $devices,
        ?string $identifier2 = null,
        ?string $producer = null,
        ?bool $has_freespins = null,
        ?string $payout = null,
        ?string $volatility_rating = null,
        ?bool $has_jackpot = null,
        ?int $lines = null,
        ?int $ways = null,
        ?string $description = null,
        ?bool $has_live = null,
        ?bool $hd = null,
        ?int $multiplier = null,
        Carbon|string|null $released_at = null,
        Carbon|string|null $recalled_at = null,
        ?array $restrictions = null,
    ) {}
}
