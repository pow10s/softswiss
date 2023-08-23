<?php

namespace Pow10s\Softswiss\Traits;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Modules\Shared\Entities\Person;
use Pow10s\Softswiss\Helpers\Hash;

trait HTTPConsumable
{
    public function send(string $action, array $data = [], string $method = 'POST'): PromiseInterface|Response
    {
        $signature = Hash::hmacSha256(
            data: $data,
            key: Config::get('softswiss.auth_token'),
        );
        $urlParams = [
            'endpoint' => Config::get('softswiss.gcp_url'),
            'action' => $action,
        ];
        Person::findMany()
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

        return $response;
    }
}
