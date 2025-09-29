<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ExportLeaksInputDto;
use App\Application\Dto\Output\Occupant\ExportLeaksOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class ExportLeaksUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ExportLeaksInputDto $inputDto): ExportLeaksOutputDto
  {
    return $this->serviceDataProvider->exportLeaksService($inputDto);
  }
}
