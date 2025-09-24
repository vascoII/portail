<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ExportDysfunctionsInputDto;
use App\Application\Dto\Output\Logement\ExportDysfunctionsOutputDto;
use App\Infrastructure\Transformer\LogementTransformer;
use App\Domain\Service\Soap\LogementSoapInterface;

final class ExportDysfunctionsUseCase
{
  public function __construct(
    private readonly LogementSoapInterface $service,
    private readonly LogementTransformer $transformer 
  ) {}
  
  public function execute(ExportDysfunctionsInputDto $inputDto): ExportDysfunctionsOutputDto
  {
    $serviceResponse = $this->service->exportDysfunctionsService($inputDto);
    return $this->transformer->transformExportDysfunctionsResponse($serviceResponse); 
  }
}
