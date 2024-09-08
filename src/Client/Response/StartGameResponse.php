<?php

declare(strict_types=1);

namespace Pow10s\Softswiss\Client\Response;

use Pow10s\Softswiss\Client\DTO;

final readonly class StartGameResponse extends DTO
{
    public function __construct(
        public string $game_url,
        public string $strategy,
        public array $launch_options,
    ) {
    }
}
