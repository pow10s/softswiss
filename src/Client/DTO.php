<?php

declare(strict_types=1);

namespace Pow10s\Softswiss\Client;

use Pow10s\Softswiss\Helpers\ArrayHelper;

readonly class DTO
{
    public function toArray(): array
    {
        $flags = JSON_THROW_ON_ERROR;

        return json_decode(
            json_encode($this, $flags),
            true,
            512,
            $flags
        );
    }

    public function toArrayWithoutNulls(): array
    {
        return ArrayHelper::filterNullValues($this->toArray());
    }

    public function toSnakeCaseArrayWithoutNulls(): array
    {
        return ArrayHelper::convertKeysToSnakeCase($this->toArrayWithoutNulls());
    }
}
