<?php

namespace Pow10s\Softswiss\Client;

use Pow10s\Softswiss\DTO\SessionInitDTO;
use Pow10s\Softswiss\Traits\HTTPConsumable;
use Pow10s\Softswiss\Client\Builders\RequestParams;

class APIClient
{
    use HTTPConsumable;

    private const ACTIONS = [
        'getDemoGame' => 'demo',
        'getRealGame' => 'sessions',
    ];

    private const CURRENCIES_MAP = [
        'DOGE' => 'DOG',
    ];

    public function getDemoGame(SessionInitDTO $sessionInitDTO): string|array
    {
        $params = RequestParams::builder()
            ->setGameIdentifier($sessionInitDTO->game)
            ->setLocale($sessionInitDTO->locale)
            ->setIp($sessionInitDTO->ip)
            ->setClientType($sessionInitDTO->client_type)
            ->withUrls($sessionInitDTO->urls)
            ->build()
            ->toArray();

        return $this->send(
            action: self::ACTIONS[__FUNCTION__],
            data: $params
        );
    }

    public function getGame(SessionInitDTO $sessionInitDTO): string|array
    {
        $currency = self::CURRENCIES_MAP[$sessionInitDTO->currency] ?? $sessionInitDTO->currency;
        $params = RequestParams::builder()
            ->setBalance($sessionInitDTO->balance)
            ->setClientType($sessionInitDTO->client_type)
            ->setCurrency($currency)
            ->setGameIdentifier($sessionInitDTO->game)
            ->setIp($sessionInitDTO->ip)
            ->setLocale($sessionInitDTO->locale)
            ->withUrls($sessionInitDTO->urls)
            ->withUser($sessionInitDTO->user)
            ->build()
            ->toArray();

        return $this->send(
            action: self::ACTIONS[__FUNCTION__],
            data: $params
        );
    }
}
