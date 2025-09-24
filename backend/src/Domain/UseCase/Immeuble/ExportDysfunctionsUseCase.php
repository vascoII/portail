<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ExportDysfunctionsInputDto;
use App\Application\Dto\Output\Immeuble\ExportDysfunctionsOutputDto;
use App\Infrastructure\Transformer\ImmeubleTransformer;
use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class ExportDysfunctionsUseCase
{
  public function __construct(
    private readonly ImmeubleSoapInterface $service,
    private readonly ImmeubleTransformer $transformer
  ) {}

  public function execute(ExportDysfunctionsInputDto $inputDto): ExportDysfunctionsOutputDto
  {
    $serviceResponse = $this->service->exportDysfunctionsService($inputDto);
    return $this->transformer->transformExportDysfunctionsResponse($serviceResponse);
  }
}
