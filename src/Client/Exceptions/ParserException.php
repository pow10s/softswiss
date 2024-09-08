<?php

declare(strict_types=1);

namespace Pow10s\Softswiss\Client\Exceptions;

class ParserException extends SoftswissAPIClientException
{
    public static function invalidFilePath(string $filePath): self
    {
        return new self(500, "Invalid file: {$filePath}");
    }

    public static function fileParsingError(string $filePath, string $message): self
    {
        return new self(500, "Error parsing file: {$filePath}. {$message}");
    }
}
