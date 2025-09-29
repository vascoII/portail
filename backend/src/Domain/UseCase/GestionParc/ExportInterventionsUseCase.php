<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ExportInterventionsInputDto;
use App\Application\Dto\Output\GestionParc\ExportInterventionsOutputDto;
use App\Application\Service\DataProvider\GestionParcDataProviderInterface;

final class ExportInterventionsUseCase
{
  public function __construct(
    private readonly GestionParcDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ExportInterventionsInputDto $inputDto): ExportInterventionsOutputDto
  {
    return $this->serviceDataProvider->exportInterventionsService($inputDto);
  }
}
