<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Facture;

use App\Application\Dto\Input\Facture\ReportInputDto;
use App\Application\Dto\Output\Facture\ReportOutputDto;
use App\Application\Service\DataProvider\FactureDataProviderInterface;

final class ReportUseCase
{
  public function __construct(
    private readonly FactureDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ReportInputDto $inputDto): ReportOutputDto
  {
    return $this->serviceDataProvider->reportService($inputDto);
  }
}
