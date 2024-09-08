<?php

declare(strict_types=1);

namespace Pow10s\Softswiss\Client\Request\Builder;

use JsonException;
use Pow10s\Softswiss\Client\Request\SessionInitRequest;

abstract class RequestParams
{
    private SessionInitRequest $requestParams;

    public function __construct(SessionInitRequest $requestParams)
    {
        $this->requestParams = $requestParams;
    }

    public static function builder(): RequestParamsBuilder
    {
        return new class () extends RequestParamsBuilder
        {
        };
    }

    public function get(): SessionInitRequest
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
