<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ListAnomaliesInputDto;
use App\Application\Dto\Output\GestionParc\ListAnomaliesOutputDto;
use App\Infrastructure\Transformer\GestionParcTransformer;
use App\Domain\Service\Soap\GestionParcSoapInterface;

final class ListAnomaliesUseCase
{
  public function __construct(
    private readonly GestionParcSoapInterface $service,
    private readonly GestionParcTransformer $transformer
  ) {}
  
  public function execute(ListAnomaliesInputDto $inputDto): ListAnomaliesOutputDto
  {
    $serviceResponse = $this->service->listAnomaliesService($inputDto);
    return $this->transformer->transformListAnomaliesResponse($serviceResponse);
  }
}
