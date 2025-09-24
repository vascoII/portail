<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ExportLeaksInputDto;
use App\Application\Dto\Output\Immeuble\ExportLeaksOutputDto;
use App\Infrastructure\Transformer\ImmeubleTransformer;
use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class ExportLeaksUseCase
{
  public function __construct(
    private readonly ImmeubleSoapInterface $service,
    private readonly ImmeubleTransformer $transformer
  ) {}

  public function execute(ExportLeaksInputDto $inputDto): ExportLeaksOutputDto
  {
    $serviceResponse = $this->service->exportLeaksService($inputDto);
    return $this->transformer->transformExportLeaksResponse($serviceResponse);
  }
}
