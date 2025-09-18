<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ListInterventionsInputDto;
use App\Application\Dto\Output\GestionParc\ListInterventionsOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class ListInterventionsUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ListInterventionsInputDto);
    return new ListInterventionsOutputDto([]);
  }
}
