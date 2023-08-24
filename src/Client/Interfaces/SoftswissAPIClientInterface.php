<?php

namespace Pow10s\Softswiss\Client\Interfaces;

use Pow10s\Softswiss\Client\Request\SessionInitRequest;
use Pow10s\Softswiss\Client\Response\StartGameResponse;

interface SoftswissAPIClientInterface
{
    public function getDemoGame(SessionInitRequest $sessionInitRequest): StartGameResponse;

    public function getGame(SessionInitRequest $sessionInitRequest): StartGameResponse;

    public function fetchGamesByProvider(string $provider): array;
}
