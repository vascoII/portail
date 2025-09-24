<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\FilterResultInputDto;
use App\Application\Dto\Output\Logement\FilterResultOutputDto;
use App\Infrastructure\Transformer\LogementTransformer;
use App\Domain\Service\Soap\LogementSoapInterface;

final class FilterResultUseCase
{
  public function __construct(
    private readonly LogementSoapInterface $service,
    private readonly LogementTransformer $transformer 
  ) {}
  
  public function execute(FilterResultInputDto $inputDto): FilterResultOutputDto
  {
    $serviceResponse = $this->service->filterResultService($inputDto);
    return $this->transformer->transformFilterResultResponse($serviceResponse); 
  }
}
