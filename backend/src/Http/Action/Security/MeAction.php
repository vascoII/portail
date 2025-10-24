<?php

declare(strict_types=1);

namespace App\Http\Action\Security;

use App\Application\Service\Auth\AuthServiceInterface;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/security/me', name: 'security_me', methods: ['GET'])]
final class MeAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder,
        private readonly AuthServiceInterface $authService
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        $user = $this->authService->getCurrentUser();

        if (! $user) {
            return $this->responder->respond([
                'success' => false,
                'error' => 'User not authenticated',
            ], 401);
        }

        return $this->responder->respond([
            'success' => true,
            'user' => [
                'loginId' => $user->loginId,
                'userName' => $user->userName,
                'email' => $user->email,
                'userType' => $user->userType,
                'firstName' => $user->firstName,
                'userRole' => $user->userRole,
                'clientId' => $user->clientId,
                'clientName' => $user->clientName,
                'showImmeublesArc' => $user->showImmeublesArc,
                'showFactures' => $user->showFactures,
                'showChgtOccupant' => $user->showChgtOccupant,
                'showChantiers' => $user->showChantiers,
            ],
        ]);
    }
}
