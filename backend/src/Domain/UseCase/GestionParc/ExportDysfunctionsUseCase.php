<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ExportDysfunctionsInputDto;
use App\Application\Dto\Output\GestionParc\ExportDysfunctionsOutputDto;
use App\Application\Service\DataProvider\GestionParcDataProviderInterface;

final class ExportDysfunctionsUseCase
{
  public function __construct(
    private readonly GestionParcDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ExportDysfunctionsInputDto $inputDto): ExportDysfunctionsOutputDto
  {
    return $this->serviceDataProvider->exportDysfunctionsService($inputDto);
  }
}
