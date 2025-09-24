<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ExportAnomaliesInputDto;
use App\Application\Dto\Output\Occupant\ExportAnomaliesOutputDto;
use App\Infrastructure\Transformer\OccupantTransformer;
use App\Domain\Service\Soap\OccupantSoapInterface;

final class ExportAnomaliesUseCase
{
  public function __construct(
    private readonly OccupantSoapInterface $service,
    private readonly OccupantTransformer $transformer
  ) {}

  public function execute(ExportAnomaliesInputDto $inputDto): ExportAnomaliesOutputDto
  {
    $serviceResponse = $this->service->exportAnomaliesService($inputDto);
    return $this->transformer->transformExportAnomaliesResponse($serviceResponse);
  }
}
