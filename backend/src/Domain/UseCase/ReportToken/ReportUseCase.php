<?php

declare(strict_types=1);

namespace App\Domain\UseCase\ReportToken;

use App\Application\Dto\Input\ReportToken\ReportInputDto;
use App\Application\Dto\Output\ReportToken\ReportOutputDto;
use App\Infrastructure\Transformer\ReportTokenTransformer;
use App\Domain\Service\Soap\ReportTokenSoapInterface;

final class ReportUseCase
{
  public function __construct(
    private readonly ReportTokenSoapInterface $service,
    private readonly ReportTokenTransformer $transformer
  ) {}

  public function execute(ReportInputDto $inputDto): ReportOutputDto
  {
    $serviceResponse = $this->service->reportService($inputDto);
    return $this->transformer->transformReportResponse($serviceResponse);
  }
}
