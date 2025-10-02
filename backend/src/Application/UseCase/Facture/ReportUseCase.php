<?php

declare(strict_types=1);

namespace App\Application\UseCase\Facture;

use App\Application\Dto\Input\Shared\GetReportInputDto;
use App\Application\Dto\Output\Facture\ReportFactureOutputDto;
use App\Application\Service\DataProvider\FactureDataProviderInterface;

final class ReportUseCase
{
  public function __construct(
    private readonly FactureDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(GetReportInputDto $inputDto): ReportFactureOutputDto
  {
    return $this->serviceDataProvider->reportService($inputDto);
  }
}
