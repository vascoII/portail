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
}
