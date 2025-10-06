<?php

declare(strict_types=1);

namespace App\Application\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ReportInputDto;
use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Application\Service\DataProvider\GestionParcDataProviderInterface;

final class ReportUseCase
{
  public function __construct(
    private readonly GestionParcDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ReportInputDto $inputDto): GetReportOutputDto
  {
    return $this->serviceDataProvider->reportService($inputDto);
  }
}
