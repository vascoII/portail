<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\FilterResultInputDto;
use App\Application\Dto\Output\Logement\FilterResultOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class FilterResultUseCase
{
  public function __construct(
    private readonly LogementDataProviderInterface $serviceDataProvider
  ) {}
  
  public function execute(FilterResultInputDto $inputDto): FilterResultOutputDto
  {
    return $this->serviceDataProvider->filterResultService($inputDto); 
  }
}
