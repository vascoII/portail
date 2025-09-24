<?php

declare(strict_types=1);

namespace App\Http\Responder;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

final class JsonResponder implements ResponderInterface
{
  public function __construct(
    private readonly SerializerInterface $serializer,
    private readonly LoggerInterface $httpLogger
  ) {}

  public function respond(mixed $payload, int $status = Response::HTTP_OK, array $headers = []): Response
  {
    $startTime = microtime(true);

    if (\is_object($payload)) {
      $json = $this->serializer->serialize($payload, 'json');
      $response = new JsonResponse($json, $status, $headers, true);
    } else {
      $response = new JsonResponse($payload, $status, $headers);
    }

    // Add request ID to response headers if available
    $request = $this->getCurrentRequest();
    if ($request && $request->attributes->has('request_id')) {
      $response->headers->set('X-Request-ID', $request->attributes->get('request_id'));
    }

    $duration = (microtime(true) - $startTime) * 1000; // Convert to milliseconds

    $this->httpLogger->debug('Response prepared', [
      'status_code' => $status,
      'duration_ms' => round($duration, 2),
      'response_size' => strlen($response->getContent()),
      'headers' => array_keys($headers),
    ]);

    return $response;
  }

  private function getCurrentRequest(): ?\Symfony\Component\HttpFoundation\Request
  {
    // This is a simplified approach - in a real app you might inject RequestStack
    return \Symfony\Component\HttpFoundation\Request::createFromGlobals();
  }
}
