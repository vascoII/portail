<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ExportLeaksInputDto;
use App\Application\Dto\Output\Occupant\ExportLeaksOutputDto;

use App\Domain\Service\Soap\OccupantSoapInterface;

final class ExportLeaksUseCase
{
  public function __construct(private readonly OccupantSoapInterface $service) {}

  public function execute(ExportLeaksInputDto $inputDto): ExportLeaksOutputDto
  {
    \assert($inputDto instanceof ExportLeaksInputDto);
    return new ExportLeaksOutputDto(true);
  }
}
