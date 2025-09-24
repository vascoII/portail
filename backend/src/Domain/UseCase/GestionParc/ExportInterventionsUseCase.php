<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ExportInterventionsInputDto;
use App\Application\Dto\Output\GestionParc\ExportInterventionsOutputDto;
use App\Infrastructure\Transformer\GestionParcTransformer;
use App\Domain\Service\Soap\GestionParcSoapInterface;

final class ExportInterventionsUseCase
{
  public function __construct(
    private readonly GestionParcSoapInterface $service,
    private readonly GestionParcTransformer $transformer
  ) {}

  public function execute(ExportInterventionsInputDto $inputDto): ExportInterventionsOutputDto
  {
    $serviceResponse = $this->service->exportInterventionsService($inputDto);
    return $this->transformer->transformExportInterventionsResponse($serviceResponse);
  }
}
