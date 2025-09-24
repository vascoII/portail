<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ListAnomaliesInputDto;
use App\Application\Dto\Output\Logement\ListAnomaliesOutputDto;
use App\Infrastructure\Transformer\LogementTransformer;
use App\Domain\Service\Soap\LogementSoapInterface;

final class ListAnomaliesUseCase
{
  public function __construct(
    private readonly LogementSoapInterface $service,
    private readonly LogementTransformer $transformer 
  ) {}
  
  public function execute(ListAnomaliesInputDto $inputDto): ListAnomaliesOutputDto
  {
    $serviceResponse = $this->service->listAnomaliesService($inputDto);
    return $this->transformer->transformListAnomaliesResponse($serviceResponse);
  }
}
