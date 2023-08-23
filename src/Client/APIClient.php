<?php

declare(strict_types=1);

namespace Pow10s\Softswiss\Client;

use Pow10s\Softswiss\Client\Request\RequestParams;
use Pow10s\Softswiss\Client\Request\DTO\SessionInitRequest;
use Pow10s\Softswiss\Client\Response\DTO\StartGameResponse;
use Pow10s\Softswiss\Traits\HTTPConsumable;

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

    public function getDemoGame(SessionInitRequest $sessionInitRequest): StartGameResponse
    {
        $params = RequestParams::builder()
            ->setGameIdentifier($sessionInitRequest->game)
            ->setLocale($sessionInitRequest->locale)
            ->setIp($sessionInitRequest->ip)
            ->setClientType($sessionInitRequest->client_type)
            ->withUrls($sessionInitRequest->urls)
            ->build()
            ->toArray();
        $response = $this->send(
            action: self::ACTIONS[__FUNCTION__],
            data: $params
        )['launch_options'];

        return new StartGameResponse(
            game_url: $response['game_url'],
            strategy: $response['strategy']
        );
    }

    public function getGame(SessionInitRequest $sessionInitRequest): StartGameResponse
    {
        $currency = self::CURRENCIES_MAP[$sessionInitRequest->currency] ?? $sessionInitRequest->currency;
        $params = RequestParams::builder()
            ->setBalance($sessionInitRequest->balance)
            ->setClientType($sessionInitRequest->client_type)
            ->setCurrency($currency)
            ->setGameIdentifier($sessionInitRequest->game)
            ->setIp($sessionInitRequest->ip)
            ->setLocale($sessionInitRequest->locale)
            ->withUrls($sessionInitRequest->urls)
            ->withUser($sessionInitRequest->user)
            ->build()
            ->toArray();
        $response = $this->send(
            action: self::ACTIONS[__FUNCTION__],
            data: $params
        )['launch_options'];

        return new StartGameResponse(
            game_url: $response['game_url'],
            strategy: $response['strategy']
        );
    }
}
