<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ExportAnomaliesInputDto;
use App\Application\Dto\Output\Logement\ExportAnomaliesOutputDto;
use App\Infrastructure\Transformer\LogementTransformer;
use App\Domain\Service\Soap\LogementSoapInterface;

final class ExportAnomaliesUseCase
{
  public function __construct(
    private readonly LogementSoapInterface $service,
    private readonly LogementTransformer $transformer 
  ) {}
  
  public function execute(ExportAnomaliesInputDto $inputDto): ExportAnomaliesOutputDto
  {
    $serviceResponse = $this->service->exportAnomaliesService($inputDto);
    return $this->transformer->transformExportAnomaliesResponse($serviceResponse); 
  }
}
