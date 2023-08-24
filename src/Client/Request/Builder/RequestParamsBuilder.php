<?php

declare(strict_types=1);

namespace Pow10s\Softswiss\Client\Request\Builder;

use Illuminate\Support\Facades\Config;
use Pow10s\Softswiss\Client\Interfaces\BuilderInterface;
use Pow10s\Softswiss\Client\Request\SessionInitRequest;
use Pow10s\Softswiss\Client\Request\UrlDTO;
use Pow10s\Softswiss\Client\Request\UserDTO;

abstract class RequestParamsBuilder implements BuilderInterface
{
    private string $casinoId;

    private string $game;

    private string $locale;

    private string $ip;

    private string $clientType;

    private UrlDTO $urls;

    private ?string $currency = null;

    private mixed $balance = null;

    private ?UserDTO $user = null;

    public function __construct()
    {
        $this->setCasinoId(Config::get('softswiss.casino_id'));
    }

    public function withUser(UserDTO $params): self
    {
        $userBuilder = new UserBuilder();
        $this->user = $userBuilder
            ->setId($params->id)
            ->setNickname($params->nickname)
            ->setEmail($params->email)
            ->setRegisteredAt($params->registered_at)
            ->setCountry($params->country)
            ->setFirstname($params->firstname)
            ->setLastname($params->lastname)
            ->setGender($params->gender)
            ->setDateOfBirth($params->date_of_birth)
            ->build();

        return $this;
    }

    public function withUrls(UrlDTO $params): self
    {
        $urlsBuilder = new UrlsBuilder();
        $this->urls = $urlsBuilder
            ->setDepositUrl($params->deposit_url)
            ->setReturnUrl($params->return_url)
            ->build();

        return $this;
    }

    public function setCasinoId(string $casinoId): self
    {
        $this->casinoId = $casinoId;

        return $this;
    }

    public function setGameIdentifier(string $gameIdentifier): self
    {
        $this->game = $gameIdentifier;

        return $this;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function setClientType(string $clientType): self
    {
        $this->clientType = $clientType;

        return $this;
    }

    public function setBalance(mixed $balance): self
    {
        $this->balance = $balance;

        return $this;
    }

    public function build(): RequestParams
    {
        $requestParams = new SessionInitRequest(
            balance: $this->balance,
            client_type: $this->clientType,
            currency: $this->currency,
            game: $this->game,
            ip: $this->ip,
            locale: $this->locale,
            urls: $this->urls,
            user: $this->user,
            casino_id: $this->casinoId,
        );

        return new class ($requestParams) extends RequestParams {
        };
    }
}
