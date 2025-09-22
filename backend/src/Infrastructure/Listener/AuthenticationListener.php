<?php

declare(strict_types=1);

namespace App\Infrastructure\Listener;

use App\Infrastructure\Service\Auth\AuthenticationContext;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class AuthenticationListener implements EventSubscriberInterface
{
  public static function getSubscribedEvents(): array
  {
    return [
      // Disabled - using JWT middleware instead
      // KernelEvents::REQUEST => ['onKernelRequest', 1000],
    ];
  }

  public function onKernelRequest(RequestEvent $event): void
  {
    if (!$event->isMainRequest()) {
      return;
    }

    $request = $event->getRequest();

    // Only process API requests
    if (!str_starts_with($request->getPathInfo(), '/api/')) {
      return;
    }

    try {
      $authContext = AuthenticationContext::fromHeaders($request->headers->all());

      // Store in request attributes for later use
      $request->attributes->set('auth_context', $authContext);
    } catch (\InvalidArgumentException $e) {
      // Handle missing authentication headers
      // This could be handled by a separate authentication middleware
      // For now, we'll let it bubble up
      throw $e;
    }
  }
}
