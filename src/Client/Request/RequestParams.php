<?php

declare(strict_types=1);

namespace Pow10s\Softswiss\Client\Request;

use JsonException;
use Pow10s\Softswiss\Client\Request\DTO\SessionInitDTO;

abstract class RequestParams
{
    private SessionInitDTO $requestParams;

    public function __construct(SessionInitDTO $requestParams)
    {
        $this->requestParams = $requestParams;
    }

    public static function builder(): RequestParamsBuilder
    {
        return new class () extends RequestParamsBuilder {
        };
    }

    public function get(): SessionInitDTO
    {
        return $this->requestParams;
    }

    /**
     * @throws JsonException
     */
    public function toArray(): array
    {
        $jsonString = json_encode(
            value: $this->requestParams,
            flags: JSON_THROW_ON_ERROR
        );

        return json_decode($jsonString, true, 512, JSON_THROW_ON_ERROR);
    }
}
