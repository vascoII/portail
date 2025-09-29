<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\SearchInputDto;
use App\Application\Dto\Output\Logement\SearchOutputDto;
use App\Application\Service\DataProvider\LogementDataProviderInterface;

final class SearchUseCase
{
  public function __construct(
    private readonly LogementDataProviderInterface $serviceDataProvider
  ) {}
  
  public function execute(SearchInputDto $inputDto): SearchOutputDto
  {
    return $this->serviceDataProvider->searchService($inputDto);
  }
}
