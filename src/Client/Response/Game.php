<?php

namespace Pow10s\Softswiss\Client\Response;

use Carbon\Carbon;
use Pow10s\Softswiss\Client\DTO;

final readonly class Game extends DTO
{
    public function __construct(
        public string $title,
        public string $identifier,
        public string $provider,
        public string $category,
        public string $feature_group,
        public array $devices,
        public ?string $identifier2 = null,
        public ?string $producer = null,
        public ?bool $has_freespins = null,
        public ?float $payout = null,
        public ?string $volatility_rating = null,
        public ?bool $has_jackpot = null,
        public ?int $lines = null,
        public ?int $ways = null,
        public ?string $description = null,
        public ?bool $has_live = null,
        public ?bool $hd = null,
        public ?float $multiplier = null,
        public ?bool $bonus_buy = null,
        public Carbon|string|null $released_at = null,
        public Carbon|string|null $recalled_at = null,
        public ?array $restrictions = null,
    ) {}
}
