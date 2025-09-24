<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ExportDysfunctionsInputDto;
use App\Application\Dto\Output\Occupant\ExportDysfunctionsOutputDto;
use App\Infrastructure\Transformer\OccupantTransformer;
use App\Domain\Service\Soap\OccupantSoapInterface;

final class ExportDysfunctionsUseCase
{
  public function __construct(
    private readonly OccupantSoapInterface $service,
    private readonly OccupantTransformer $transformer
  ) {}

  public function execute(ExportDysfunctionsInputDto $inputDto): ExportDysfunctionsOutputDto
  {
    $serviceResponse = $this->service->exportDysfunctionsService($inputDto);
    return $this->transformer->transformExportDysfunctionsResponse($serviceResponse);
  }
}
