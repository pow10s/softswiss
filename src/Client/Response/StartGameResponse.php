<?php

namespace Pow10s\Softswiss\Client\Response;

final readonly class StartGameResponse
{
    public function __construct(
        public string $game_url,
        public string $strategy,
        public array $launch_options,
    )
    {
    }
}
