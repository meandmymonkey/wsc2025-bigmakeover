<?php

declare(strict_types=1);

namespace App\LegacyBridge\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\PreAuthenticatedUserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

final class LegacyAuthenticator extends AbstractAuthenticator
{
    public function __construct(
        private readonly LegacyUserProvider $userProvider,
    ) {
        if (\PHP_SESSION_ACTIVE !== session_status()) {
            session_start();
        }
    }

    public function supports(Request $request): bool
    {
        if (isset($_SESSION['user_id']) && isset($_SESSION['is_logged_in'])) {
            return true;
        }

        return false;
    }

    public function authenticate(Request $request): Passport
    {
        $user = $this->userProvider->loadUserByLegacyId((int) $_SESSION['user_id']);

        $userBadge = new UserBadge($user->getEmail(), $this->userProvider->loadUserByIdentifier(...));

        return new SelfValidatingPassport($userBadge, [new PreAuthenticatedUserBadge()]);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return null;
    }
}
