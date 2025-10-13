<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

use App\Application\Dto\Input\Shared\GetByIdIntInputDto;

final class LogementHydrator
{

    public function hydrateGetLogement(GetByIdIntInputDto $inputDto): object
    {
      return (object) [
        'PkLogement' => $inputDto->id,
        'PkOccupant' => $inputDto->pkOccupant ?? -1
      ];
    }
  
}
