<?php

declare(strict_types=1);

namespace App\Http\Action\Security;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\Service\Auth\AuthServiceInterface;
use App\Domain\Service\Redis\RedisServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/security/logout', name: 'security_logout', methods: ['POST'])]
final class LogoutAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly AuthServiceInterface $authService,
    private readonly RedisServiceInterface $redisService
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $sessionId = $this->authService->getCurrentSessionId();

    if ($sessionId) {
      $this->redisService->deleteSession($sessionId);
    }

    return $this->responder->respond([
      'success' => true,
      'message' => 'Logged out successfully'
    ]);
  }
}
