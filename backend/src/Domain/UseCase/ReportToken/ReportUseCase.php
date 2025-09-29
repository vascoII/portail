<?php

declare(strict_types=1);

namespace App\Domain\UseCase\ReportToken;

use App\Application\Dto\Input\ReportToken\ReportInputDto;
use App\Application\Dto\Output\ReportToken\ReportOutputDto;
use App\Application\Service\DataProvider\ReportTokenDataProviderInterface;

final class ReportUseCase
{
  public function __construct(
    private readonly ReportTokenDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ReportInputDto $inputDto): ReportOutputDto
  {
    return $this->serviceDataProvider->reportService($inputDto);
  }
}
