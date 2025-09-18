<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ListInterventionsInputDto;
use App\Application\Dto\Output\Immeuble\ListInterventionsOutputDto;

use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class ListInterventionsUseCase
{
  public function __construct(private readonly ImmeubleSoapInterface $service) {}

  public function execute(ListInterventionsInputDto $inputDto): ListInterventionsOutputDto
  {
    \assert($inputDto instanceof ListInterventionsInputDto);
    return new ListInterventionsOutputDto([]);
  }
}
