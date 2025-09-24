<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ExportAnomaliesInputDto;
use App\Application\Dto\Output\Immeuble\ExportAnomaliesOutputDto;
use App\Infrastructure\Transformer\ImmeubleTransformer;
use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class ExportAnomaliesUseCase
{
  public function __construct(
    private readonly ImmeubleSoapInterface $service,
    private readonly ImmeubleTransformer $transformer
  ) {}

  public function execute(ExportAnomaliesInputDto $inputDto): ExportAnomaliesOutputDto
  {
    $serviceResponse = $this->service->exportAnomaliesService($inputDto);
    return $this->transformer->transformExportAnomaliesResponse($serviceResponse);
  }
}
