<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ExportAnomaliesInputDto;
use App\Application\Dto\Output\Occupant\ExportAnomaliesOutputDto;
use App\Domain\UseCase\UseCaseInterface;
use App\Domain\Service\Soap\OccupantSoapInterface;

final class ExportAnomaliesUseCase implements UseCaseInterface
{
  public function __construct(private readonly OccupantSoapInterface $service) {}

  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ExportAnomaliesInputDto);
    return new ExportAnomaliesOutputDto(true);
  }
}
