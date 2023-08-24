<?php

namespace Pow10s\Softswiss\Client\Response\Factories;

use Carbon\Carbon;
use Pow10s\Softswiss\Client\Response\Game;

class GameFactory
{
    public static function fromResponse(array $game): Game
    {
        return new Game(
            title: $game['title'],
            identifier: $game['identifier'],
            provider: $game['provider'],
            category: $game['category'],
            feature_group: $game['feature_group'],
            devices: $game['devices'],
            identifier2: $game['identifier2'] ?? null,
            producer: $game['producer'] ?? null,
            has_freespins: $game['has_freespins'] ?? null,
            payout: $game['payout'] ?? null,
            volatility_rating: $game['volatility_rating'] ?? null,
            has_jackpot: $game['has_jackpot'] ?? null,
            lines: $game['lines'] ?? null,
            ways: $game['ways'] ?? null,
            description: $game['description'] ?? null,
            has_live: $game['has_live'] ?? null,
            hd: $game['hd'] ?? null,
            multiplier: $game['multiplier'] ?? null,
            bonus_buy: $game['bonus_buy'] ?? null,
            released_at: isset($game['released_at'])
                ? Carbon::createFromTimestamp($game['released_at'])->toDateTimeString()
                : null,
            recalled_at: isset($game['recalled_at'])
                ? Carbon::createFromTimestamp($game['recalled_at'])->toDateTimeString()
                : null,
            restrictions: $game['restrictions'] ?? null,
        );
    }
}
