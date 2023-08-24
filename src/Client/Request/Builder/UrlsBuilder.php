<?php

declare(strict_types=1);

namespace Pow10s\Softswiss\Client\Request\Builder;

use Pow10s\Softswiss\Client\Interfaces\BuilderInterface;
use Pow10s\Softswiss\Client\Request\UrlDTO;

class UrlsBuilder implements BuilderInterface
{
    private ?string $returnUrl = null;

    private ?string $depositUrl = null;

    public function setReturnUrl(?string $returnUrl): self
    {
        $this->returnUrl = $returnUrl;

        return $this;
    }

    public function setDepositUrl(?string $depositUrl): self
    {
        $this->depositUrl = $depositUrl;

        return $this;
    }

    private function getReturnUrl(): ?string
    {
        return $this->returnUrl;
    }

    private function getDepositUrl(): ?string
    {
        return $this->depositUrl;
    }

    public function build(): UrlDTO
    {
        return new UrlDTO(
            return_url: $this->getReturnUrl(),
            deposit_url: $this->getDepositUrl()
        );
    }
}
