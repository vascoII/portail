<?php

declare(strict_types=1);

namespace App\Http\Action;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractAction implements ActionInterface
{
  protected function json(mixed $data, int $status = Response::HTTP_OK, array $headers = []): JsonResponse
  {
    return new JsonResponse($data, $status, $headers);
  }

  /**
   * Helper method to create API route path with /api prefix
   */
  protected static function apiPath(string $path): string
  {
    return '/api' . $path;
  }
}
