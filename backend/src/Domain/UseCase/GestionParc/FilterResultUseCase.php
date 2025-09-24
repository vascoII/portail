<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\FilterResultInputDto;
use App\Application\Dto\Output\GestionParc\FilterResultOutputDto;
use App\Infrastructure\Transformer\GestionParcTransformer;
use App\Domain\Service\Soap\GestionParcSoapInterface;

final class FilterResultUseCase
{
  public function __construct(
    private readonly GestionParcSoapInterface $service,
    private readonly GestionParcTransformer $transformer
  ) {}
  
  public function execute(FilterResultInputDto $inputDto): FilterResultOutputDto
  {
    $serviceResponse = $this->service->filterResultService($inputDto);
    return $this->transformer->transformFilterResultResponse($serviceResponse);
  }
}
