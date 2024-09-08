<?php

declare(strict_types=1);

namespace Pow10s\Softswiss\Client\Interfaces;

use Exception;
use Pow10s\Softswiss\Client\Exceptions\SoftswissAPIClientException;
use Pow10s\Softswiss\Client\Request\RoundDetailsRequestDTO;
use Pow10s\Softswiss\Client\Request\SessionInitRequest;
use Pow10s\Softswiss\Client\Response\RoundDetailsResponseDTO;
use Pow10s\Softswiss\Client\Response\StartGameResponse;

interface SoftswissAPIClientInterface
{
    public function getDemoGame(SessionInitRequest $sessionInitRequest): StartGameResponse;

    public function getGame(SessionInitRequest $sessionInitRequest): StartGameResponse;

    public function fetchGamesByProvider(string $provider): array;

    /**
     * Retrieve round details.
     *
     * @throws SoftswissAPIClientException
     * @throws Exception
     */
    public function getRoundDetails(RoundDetailsRequestDTO $roundDetailsDTO): RoundDetailsResponseDTO;
}
