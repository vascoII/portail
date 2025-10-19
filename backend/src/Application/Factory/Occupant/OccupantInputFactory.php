<?php

declare(strict_types=1);

namespace App\Application\Factory\Occupant;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\Shared\GetByIdIntInputDto;
use App\Application\Dto\Input\Shared\GetByEnergyStringInputDto;

final class OccupantInputFactory
{
  public function createGetByIdFromRequest(Request $request, array $args = []): GetByIdIntInputDto
  {
    $id = (int) ($args['id'] ?? $request->query->get('id', 0));
    return new GetByIdIntInputDto($id);
  }

  public function createGetByEnergyFromRequest(Request $request, array $args = []): GetByEnergyStringInputDto
  {
    $energy = (string) ($args['energy'] ?? $request->query->get('energy', ''));
    return new GetByEnergyStringInputDto($energy);
  }
}
