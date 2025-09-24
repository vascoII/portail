<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\SearchInputDto;
use App\Application\Dto\Output\Logement\SearchOutputDto;
use App\Infrastructure\Transformer\LogementTransformer;
use App\Domain\Service\Soap\LogementSoapInterface;

final class SearchUseCase
{
  public function __construct(
    private readonly LogementSoapInterface $service,
    private readonly LogementTransformer $transformer 
  ) {}
  
  public function execute(SearchInputDto $inputDto): SearchOutputDto
  {
    $serviceResponse = $this->service->searchService($inputDto);
     return $this->transformer->transformSearchResponse($serviceResponse);
  }
}
