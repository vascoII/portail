<?php

declare(strict_types=1);

namespace App\Application\Factory\Ticket;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

final class TicketInputFactory
{
  public function createGetByIdFromRequest(Request $request, array $args = []): GetByIdIntInputDto
  {
    $id = (int) ($args['id'] ?? $request->query->get('id', 0));
    return new GetByIdIntInputDto($id);
  }
}
