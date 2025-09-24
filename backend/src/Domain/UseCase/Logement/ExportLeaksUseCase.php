<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ExportLeaksInputDto;
use App\Application\Dto\Output\Logement\ExportLeaksOutputDto;
use App\Infrastructure\Transformer\LogementTransformer;
use App\Domain\Service\Soap\LogementSoapInterface;

final class ExportLeaksUseCase
{
  public function __construct(
    private readonly LogementSoapInterface $service,
    private readonly LogementTransformer $transformer 
  ) {}
  
  public function execute(ExportLeaksInputDto $inputDto): ExportLeaksOutputDto
  {
    $serviceResponse = $this->service->exportLeaksService($inputDto);
    return $this->transformer->transformExportLeaksResponse($serviceResponse); 
  }
}
