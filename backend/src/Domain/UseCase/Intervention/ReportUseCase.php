<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Intervention;

use App\Application\Dto\Input\Intervention\ReportInputDto;
use App\Application\Dto\Output\Intervention\ReportOutputDto;
use App\Infrastructure\Transformer\InterventionTransformer;
use App\Domain\Service\Soap\InterventionSoapInterface;

final class ReportUseCase
{
  public function __construct(
    private readonly InterventionSoapInterface $service,
    private readonly InterventionTransformer $transformer    
  ) {}

  public function execute(ReportInputDto $inputDto): ReportOutputDto
  {
    $serviceResponse = $this->service->reportService($inputDto);
    return $this->transformer->transformReportResponse($serviceResponse);
  }
}
