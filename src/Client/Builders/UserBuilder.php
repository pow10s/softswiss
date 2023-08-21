<?php

declare(strict_types=1);

namespace Pow10s\Softswiss\Client\Builders;

use Pow10s\Softswiss\DTO\UserDTO;
use Pow10s\Softswiss\Client\Interfaces\BuilderInterface;
use Carbon\Carbon;

class UserBuilder implements BuilderInterface
{
    private ?string $id = null;

    private ?string $nickname = null;

    private ?string $email = null;

    private string|Carbon|null $registeredAt = null;

    private ?string $country = null;

    private ?string $firstname = null;

    private ?string $lastname = null;

    private ?string $gender = null;

    private string|Carbon|null $dateOfBirth = null;

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setRegisteredAt(string|Carbon|null $registeredAt): self
    {
        $this->registeredAt = $registeredAt;

        return $this;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function setDateOfBirth(string|Carbon|null $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    private function getId(): ?string
    {
        return $this->id;
    }

    private function getNickname(): ?string
    {
        return $this->nickname;
    }

    private function getEmail(): ?string
    {
        return $this->email;
    }

    private function getRegisteredAt(): string|Carbon|null
    {
        return $this->registeredAt;
    }

    private function getCountry(): ?string
    {
        return $this->country;
    }

    private function getFirstname(): ?string
    {
        return $this->firstname;
    }

    private function getLastname(): ?string
    {
        return $this->lastname;
    }

    private function getGender(): ?string
    {
        return $this->gender;
    }

    private function getDateOfBirth(): string|Carbon|null
    {
        return $this->dateOfBirth;
    }

    public function build(): UserDTO
    {
        return new UserDTO(
            id: $this->getId(),
            nickname: $this->getNickname(),
            email: $this->getEmail(),
            registered_at: $this->getRegisteredAt(),
            country: $this->getCountry(),
            firstname: $this->getFirstname(),
            lastname: $this->getLastname(),
            gender: $this->getGender(),
            date_of_birth: $this->getDateOfBirth(),
        );
    }
}
