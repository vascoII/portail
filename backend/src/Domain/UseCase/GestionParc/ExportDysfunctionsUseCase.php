<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ExportDysfunctionsInputDto;
use App\Application\Dto\Output\GestionParc\ExportDysfunctionsOutputDto;
use App\Infrastructure\Transformer\GestionParcTransformer;
use App\Domain\Service\Soap\GestionParcSoapInterface;

final class ExportDysfunctionsUseCase
{
  public function __construct(
    private readonly GestionParcSoapInterface $service,
    private readonly GestionParcTransformer $transformer
  ) {}

  public function execute(ExportDysfunctionsInputDto $inputDto): ExportDysfunctionsOutputDto
  {
    $serviceResponse = $this->service->exportDysfunctionsService($inputDto);
    return $this->transformer->transformExportDysfunctions($serviceResponse);
  }
}
