<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ExportLeaksInputDto;
use App\Application\Dto\Output\GestionParc\ExportLeaksOutputDto;
use App\Infrastructure\Transformer\GestionParcTransformer;
use App\Domain\Service\Soap\GestionParcSoapInterface;

final class ExportLeaksUseCase
{
  public function __construct(
    private readonly GestionParcSoapInterface $service,
    private readonly GestionParcTransformer $transformer
  ) {}
  
  public function execute(ExportLeaksInputDto $inputDto): ExportLeaksOutputDto
  {
    $serviceResponse = $this->service->exportLeaksService($inputDto);
    return $this->transformer->transformExportLeaksResponse($serviceResponse);
  }
}
