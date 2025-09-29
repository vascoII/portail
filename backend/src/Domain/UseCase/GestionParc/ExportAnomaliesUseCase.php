<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ExportAnomaliesInputDto;
use App\Application\Dto\Output\GestionParc\ExportAnomaliesOutputDto;
use App\Application\Service\DataProvider\GestionParcDataProviderInterface;

final class ExportAnomaliesUseCase
{
  public function __construct(
    private readonly GestionParcDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ExportAnomaliesInputDto $inputDto): ExportAnomaliesOutputDto
  {
    return $this->serviceDataProvider->exportAnomaliesService($inputDto);
  }
}
