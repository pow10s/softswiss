<?php

namespace Pow10s\Softswiss\Traits;

use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Pow10s\Softswiss\Helpers\Hash;
use Pow10s\Softswiss\Helpers\Url;

trait HTTPConsumable
{
    public function send(string $action, array $data = [], string $method = 'POST'): array
    {
        $signature = Hash::hmacSha256(
            data: $data,
            key: Config::get('softswiss.auth_token'),
        );
        $url = Url::format(Config::get('softswiss.gcp_url'), $action);
        $headers = ['X-REQUEST-SIGN' => $signature];
        $response = Http::withHeaders($headers)
            ->timeout(30)
            ->send(
                method: $method,
                url: $url,
                options: [
                    RequestOptions::JSON => $data,
                ]
            );

        return $response->json();
    }
}
