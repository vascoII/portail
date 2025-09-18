<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ListAnomaliesInputDto;
use App\Application\Dto\Output\Immeuble\ListAnomaliesOutputDto;

use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class ListAnomaliesUseCase
{
  public function __construct(private readonly ImmeubleSoapInterface $service) {}

  public function execute(ListAnomaliesInputDto $inputDto): ListAnomaliesOutputDto
  {
    \assert($inputDto instanceof ListAnomaliesInputDto);
    return new ListAnomaliesOutputDto([]);
  }
}
