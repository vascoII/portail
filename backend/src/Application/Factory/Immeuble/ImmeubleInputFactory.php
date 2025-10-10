<?php

declare(strict_types=1);

namespace App\Application\Factory\Immeuble;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

final class ImmeubleInputFactory
{
  public function getImmeubleFromRoute(Request $request): GetByIdIntInputDto
  {
      return new GetByIdIntInputDto(id: (int) $request->attributes->get('immeubleId'));
  }
}
