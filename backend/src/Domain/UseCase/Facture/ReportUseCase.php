<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Facture;

use App\Application\Dto\Input\Facture\ReportInputDto;
use App\Application\Dto\Output\Facture\ReportOutputDto;
use App\Domain\Service\Soap\FactureSoapInterface;
use App\Infrastructure\Transformer\FactureTransformer;

final class ReportUseCase
{
  public function __construct(
    private readonly FactureSoapInterface $service,
    private readonly FactureTransformer $transformer
  ) {}

  public function execute(ReportInputDto $inputDto): ReportOutputDto
  {
    $serviceResponse = $this->service->reportService($inputDto);
    return $this->transformer->transformReportResponse($serviceResponse);
  }
}
