<?php

declare(strict_types=1);

namespace App\LegacyBridge\Security;

use Doctrine\DBAL\Connection;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final readonly class LegacyUserProvider implements UserProviderInterface
{
    public function __construct(private Connection $dbal) {}

    public function loadUserByIdentifier(string $identifier): LegacyUser
    {
        $userData = $this->dbal->executeQuery("
            SELECT id, email, display_name, created_at
            FROM users
            WHERE email = ? AND enabled = true
        ", [$identifier])->fetchAssociative();

        if (false === $userData) {
            throw new UserNotFoundException();
        }

        return new LegacyUser(
            $userData['email'],
            $userData['display_name'],
            new \DateTimeImmutable($userData['created_at'])
        );
    }

    public function loadUserByLegacyId(int $id): LegacyUser
    {
        $userData = $this->dbal->executeQuery("
            SELECT id, email, display_name, created_at
            FROM users
            WHERE id = ? AND enabled = true
        ", [$id])->fetchAssociative();

        if (false === $userData) {
            throw new UserNotFoundException();
        }

        return new LegacyUser(
            $userData['email'],
            $userData['display_name'],
            new \DateTimeImmutable($userData['created_at'])
        );
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->loadUserByIdentifier($user->getUserIdentifier());
    }

    public function supportsClass(string $class): bool
    {
        return LegacyUser::class === $class;
    }
}
