<?php

declare(strict_types=1);

namespace App\LegacyBridge\Security;

use Symfony\Component\Security\Core\User\UserInterface;

final readonly class LegacyUser implements UserInterface
{
    public function __construct(
        private string $email,
        private string $displayName,
        private \DateTimeImmutable $createdAt,
    ) {}


    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials(): void
    {
        // noop
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
