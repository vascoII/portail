<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ExportInterventionsInputDto;
use App\Application\Dto\Output\Occupant\ExportInterventionsOutputDto;
use App\Infrastructure\Transformer\OccupantTransformer;
use App\Domain\Service\Soap\OccupantSoapInterface;

final class ExportInterventionsUseCase
{
  public function __construct(
    private readonly OccupantSoapInterface $service,
    private readonly OccupantTransformer $transformer
  ) {}

  public function execute(ExportInterventionsInputDto $inputDto): ExportInterventionsOutputDto
  {
    $serviceResponse = $this->service->exportInterventionsService($inputDto);
    return $this->transformer->transformExportInterventionsResponse($serviceResponse);
  }
}
