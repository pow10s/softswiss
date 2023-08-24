<?php

namespace Pow10s\Softswiss\Client;

use Symfony\Component\Yaml\Yaml;

class Parser
{
    public static function parseYaml(string $yaml): array
    {
        return Yaml::parse($yaml);
    }
}
