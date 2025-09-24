<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ExportInterventionsInputDto;
use App\Application\Dto\Output\Immeuble\ExportInterventionsOutputDto;
use App\Infrastructure\Transformer\ImmeubleTransformer;
use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class ExportInterventionsUseCase
{
  public function __construct(
    private readonly ImmeubleSoapInterface $service,
    private readonly ImmeubleTransformer $transformer
  ) {}

  public function execute(ExportInterventionsInputDto $inputDto): ExportInterventionsOutputDto
  {
    $serviceResponse = $this->service->exportInterventionsService($inputDto);
    return $this->transformer->transformExportInterventionsResponse($serviceResponse);
  }
}
