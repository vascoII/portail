<?php

declare(strict_types=1);

namespace App\Http\Responder;

use Symfony\Component\HttpFoundation\Response;

interface ResponderInterface
{
  public function respond(
    mixed $payload, int $status = Response::HTTP_OK, 
    array $headers = []
  ): Response;
}
