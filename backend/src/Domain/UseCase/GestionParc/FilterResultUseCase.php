<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\FilterResultInputDto;
use App\Application\Dto\Output\GestionParc\FilterResultOutputDto;
use App\Application\Service\DataProvider\GestionParcDataProviderInterface;

final class FilterResultUseCase
{
  public function __construct(
    private readonly GestionParcDataProviderInterface $serviceDataProvider
  ) {}
  
  public function execute(FilterResultInputDto $inputDto): FilterResultOutputDto
  {
    return $this->serviceDataProvider->filterResultService($inputDto);
  }
}
