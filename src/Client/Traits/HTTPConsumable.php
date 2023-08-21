<?php

namespace Pow10s\Softswiss\Traits;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Pow10s\Softswiss\Helpers\Hash;

trait HTTPConsumable
{
    public function send(string $action, array $data = [], string $method = 'POST'): PromiseInterface|Response
    {
        $signature = Hash::hmacSha256(
            data: $data,
            key: config('softswiss.auth_token'),
        );
        $urlParams = [
            'endpoint' => config('softswiss.gcp_url'),
            'action' => $action,
        ];
        $headers = ['X-REQUEST-SIGN' => $signature];
        $response = Http::withUrlParameters($urlParams)
            ->withHeaders($headers)
            ->timeout(30)
            ->asJson()
            ->send(
                method: $method,
                url: '{+endpoint}/{action}',
                options: $data
            );

        return $response->s();
    }
}
