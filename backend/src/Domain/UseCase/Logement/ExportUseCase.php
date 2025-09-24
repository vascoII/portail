<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ExportInputDto;
use App\Application\Dto\Output\Logement\ExportOutputDto;
use App\Infrastructure\Transformer\LogementTransformer;
use App\Domain\Service\Soap\LogementSoapInterface;

final class ExportUseCase
{
  public function __construct(
    private readonly LogementSoapInterface $service,
    private readonly LogementTransformer $transformer 
  ) {}
  
  public function execute(ExportInputDto $inputDto): ExportOutputDto
  {
    $serviceResponse = $this->service->exportService($inputDto);
    return $this->transformer->transformExportResponse($serviceResponse); 
  }
}
