<?php

declare(strict_types=1);

namespace Pow10s\Softswiss\Helpers;

class ArrayHelper
{
    public static function convertKeysToSnakeCase($data): array
    {
        if (is_array($data)) {
            $snakeCaseData = [];
            foreach ($data as $key => $value) {
                $snakeCaseKey = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', (string)$key));
                if (is_array($value)) {
                    $snakeCaseData[$snakeCaseKey] = self::convertKeysToSnakeCase($value);
                } else {
                    $snakeCaseData[$snakeCaseKey] = $value;
                }
            }

            return $snakeCaseData;
        }

        return $data;
    }

    public static function filterNullValues(array $array): array
    {
        return array_filter(
            array_map(function ($item) {
                return is_array($item) ? $this->filterNullValues($item) : $item;
            }, $array),
            static function ($value) {
                // Keep the value if it is not null
                return $value !== null;
            }
        );
    }
}
