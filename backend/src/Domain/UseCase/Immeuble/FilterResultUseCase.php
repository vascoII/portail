<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\FilterResultInputDto;
use App\Application\Dto\Output\Immeuble\FilterResultOutputDto;
use App\Application\Service\DataProvider\ImmeubleDataProviderInterface;

final class FilterResultUseCase
{
  public function __construct(
    private readonly ImmeubleDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(FilterResultInputDto $inputDto): FilterResultOutputDto
  {
    return $this->serviceDataProvider->filterResultService($inputDto);
  }
}
