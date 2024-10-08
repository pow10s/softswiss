<?php

declare(strict_types=1);

namespace Pow10s\Softswiss\Client;

use Exception;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use JsonException;
use Pow10s\Softswiss\Client\Exceptions\ClientException;
use Pow10s\Softswiss\Client\Exceptions\ParserException;
use Pow10s\Softswiss\Client\Exceptions\SoftswissAPIClientException;
use Pow10s\Softswiss\Client\Request\Builder\RequestParams;
use Pow10s\Softswiss\Client\Request\RoundDetailsRequestDTO;
use Pow10s\Softswiss\Client\Request\SessionInitRequest;
use Pow10s\Softswiss\Client\Response\Factories\GameFactory;
use Pow10s\Softswiss\Client\Response\Factories\ResponseFactory;
use Pow10s\Softswiss\Client\Response\Game;
use Pow10s\Softswiss\Client\Response\RoundDetailsResponseDTO;
use Pow10s\Softswiss\Client\Response\StartGameResponse;
use Pow10s\Softswiss\Helpers\Hash;
use Pow10s\Softswiss\Helpers\Url;
use Symfony\Component\Yaml\Exception\ParseException;

class APIClient implements Interfaces\SoftswissAPIClientInterface
{
    private const GAME_LIST_URL = 'https://cdn.softswiss.net/l/<provider>.yaml';

    private const ACTIONS = [
        'getDemoGame' => 'demo',
        'getGame' => 'sessions',
        'getRoundDetails' => 'rounds/details',
    ];

    private const CURRENCIES_MAP = [
        'DOGE' => 'DOG',
    ];
    public function __construct(
        private readonly ResponseFactory $responseFactory
    ) {
    }

    /**
     * @throws SoftswissAPIClientException
     * @throws Exception
     */
    public function send(string $action, array $data = [], string $method = 'POST'): array
    {
        if (!isset($data['casino_id'])) {
            $data += ['casino_id' => Config::get('softswiss.casino_id')];
        }

        $signature = Hash::hmacSha256(
            data: $data,
            key: Config::get('softswiss.auth_token'),
        );
        $url = Url::format(Config::get('softswiss.gcp_url'), $action);
        $headers = ['X-REQUEST-SIGN' => $signature];
        $request = Http::withHeaders($headers)
            ->timeout(30)
            ->send(
                method: $method,
                url: $url,
                options: [
                    RequestOptions::JSON => $data,
                ]
            );
        $response = $request->json();
        if ($request->successful() === false) {
            throw new SoftswissAPIClientException(
                statusCode: $request->status(),
                message: $response['message'] ?? 'Unknown error',
                code: $response['code'] ?? 0,
            );
        }

        return $response;
    }

    /**
     * Get demo game start options.
     *
     * @throws JsonException
     *
     * @throws Exception
     */
    public function getDemoGame(SessionInitRequest $sessionInitRequest): StartGameResponse
    {
        $params = RequestParams::builder()
            ->setGameIdentifier($sessionInitRequest->game)
            ->setLocale($sessionInitRequest->locale)
            ->setIp($sessionInitRequest->ip)
            ->setClientType($sessionInitRequest->client_type)
            ->withUrls($sessionInitRequest->urls)
            ->build()
            ->toArray();
        $response = $this->send(
            action: self::ACTIONS[__FUNCTION__],
            data: $params
        );
        if (!$response['launch_options']) {
            throw new ClientException(400, 'No launch options');
        }

        $response = $response['launch_options'];

        return new StartGameResponse(
            game_url: $response['game_url'] ?? $response['desktop_url'] ?? '',
            strategy: $response['strategy'],
            launch_options: $response
        );
    }

    /**
     * Get real game start options.
     *
     * @throws JsonException
     *
     * @throws Exception
     */
    public function getGame(SessionInitRequest $sessionInitRequest): StartGameResponse
    {
        $currency = self::CURRENCIES_MAP[$sessionInitRequest->currency] ?? $sessionInitRequest->currency;
        $params = RequestParams::builder()
            ->setBalance($sessionInitRequest->balance)
            ->setClientType($sessionInitRequest->client_type)
            ->setCurrency($currency)
            ->setGameIdentifier($sessionInitRequest->game)
            ->setIp($sessionInitRequest->ip)
            ->setLocale($sessionInitRequest->locale)
            ->withUrls($sessionInitRequest->urls)
            ->withUser($sessionInitRequest->user)
            ->build()
            ->toArray();
        $response = $this->send(
            action: self::ACTIONS[__FUNCTION__],
            data: $params
        );
        // todo move duplicate to common place
        if (!$response['launch_options']) {
            throw new ClientException(400, 'No launch options');
        }

        $response = $response['launch_options'];

        return new StartGameResponse(
            game_url: $response['game_url'] ?? $response['desktop_url'] ?? '',
            strategy: $response['strategy'],
            launch_options: $response
        );
    }

    /**
     * Fetch games by provider.
     *
     * @return array<Game>
     * @throws SoftswissAPIClientException
     */
    public function fetchGamesByProvider(string $provider): array
    {
        $url = str_replace('<provider>', strtolower($provider), self::GAME_LIST_URL);
        $file = @file_get_contents($url);
        if ($file === false) {
            throw ParserException::invalidFilePath($url);
        }

        try {
            $games = Parser::parseYaml($file);
        } catch (ParseException $exception) {
            throw ParserException::fileParsingError($url, $exception->getMessage());
        }

        return collect($games)
            ->transform(function ($game) {
                return GameFactory::fromResponse($game);
            })
            ->all();
    }

    /**
     * Retrieve round details.
     *
     * @throws SoftswissAPIClientException
     * @throws Exception
     */
    public function getRoundDetails(RoundDetailsRequestDTO $roundDetailsDTO): RoundDetailsResponseDTO
    {
        return $this->responseFactory->fromRoundDetailsResponse(
            $this->send(
                action: self::ACTIONS[__FUNCTION__],
                data: $roundDetailsDTO->toSnakeCaseArrayWithoutNulls()
            )
        );
    }
}
