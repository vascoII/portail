<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Application\Service\AuthorizationService;
use App\Http\Attribute\RequireUserType;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;

final class UserTypeAuthorizationMiddleware
{
    public function __construct(
        private readonly AuthorizationService $authorizationService,
        private readonly LoggerInterface $securityLogger
    ) {}

    public function __invoke(RequestEvent $event): void
    {
        $request = $event->getRequest();

        // Récupérer l'attribut RequireUserType depuis le contrôleur
        $controller = $request->attributes->get('_controller');
        $requireUserType = null;

        if (is_string($controller) && class_exists($controller)) {
            $reflection = new \ReflectionClass($controller);
            $attributes = $reflection->getAttributes(RequireUserType::class);
            if (! empty($attributes)) {
                $requireUserType = $attributes[0]->newInstance();
            }
        }

        if (! $requireUserType) {
            return; // Pas de restriction définie
        }

        $allowedTypes = $requireUserType->allowedTypes;

        if (! $this->authorizationService->isUserTypeAllowed($allowedTypes)) {
            $userType = $this->authorizationService->getCurrentUserType() ?? 'unknown';

            $this->securityLogger->warning('Access denied: User type not allowed', [
                'route' => $request->attributes->get('_route'),
                'user_type' => $userType,
                'allowed_types' => $allowedTypes,
                'ip' => $request->getClientIp(),
            ]);

            $event->setResponse(new JsonResponse([
                'success' => false,
                'error' => 'Access denied: Insufficient privileges',
                'code' => 'ACCESS_DENIED',
            ], 403));
        }
    }
}
