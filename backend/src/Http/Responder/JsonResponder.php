<?php

declare(strict_types=1);

namespace App\Http\Responder;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

final class JsonResponder implements ResponderInterface
{
  public function __construct(private readonly SerializerInterface $serializer) {}

  public function respond(mixed $payload, int $status = Response::HTTP_OK, array $headers = []): Response
  {
    if (\is_object($payload)) {
      $json = $this->serializer->serialize($payload, 'json');
      return new JsonResponse($json, $status, $headers, true);
    }

    return new JsonResponse($payload, $status, $headers);
  }
}
