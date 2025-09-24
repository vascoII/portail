<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\IndexInputDto;
use App\Application\Dto\Output\GestionParc\IndexOutputDto;
use App\Infrastructure\Transformer\GestionParcTransformer;
use App\Domain\Service\Soap\GestionParcSoapInterface;

final class IndexUseCase
{
  public function __construct(
    private readonly GestionParcSoapInterface $service,
    private readonly GestionParcTransformer $transformer
  ) {}
  
  public function execute(IndexInputDto $inputDto): IndexOutputDto
  {
    $serviceResponse = $this->service->indexService($inputDto);
    return $this->transformer->transformIndexResponse($serviceResponse);
  }
}
